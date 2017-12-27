<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Entity\Team;
use BackendBundle\Entity\Tournament;
use BackendBundle\Entity\TournamentTeam;
use BackendBundle\Entity\TournamentGame;
use AppBundle\Form\TournamentType;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Library\Fixture\GroupFixture;
use AppBundle\Library\StaticChoice\MatchTypeStaticChoice;
use AppBundle\Library\StaticChoice\MatchTimeStaticChoice;
/**
 * Equipo controller.
 *
 * @Route("torneos")
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class TournamentController extends Controller
{
    /**
     * Lists all tournaments entities.
     *
     * @Route("/", name="app_tournament_index")
     * @Method("GET")
     * @Template
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getManager()->getRepository(Tournament::class);
        $paginator = $this->get('knp_paginator');

        return array(
            'pagination' => $paginator->paginate(
                $repo->getByUserQuery($this->getUser()),
                $request->query->get('page', 1),
                6
            )
        );
    }

    /**
     * Lists all tournaments entities.
     *
     * @Route("/{id}/step/{nextstep}", name="app_tournament_step")
     * @Method({"GET", "POST"})
     */
    public function stepAction(Request $request, Tournament $entity, $nextstep)
    {
        $redirects = ['app_tournament_edit', 'app_tournament_add_team', 'app_tournament_generate'];
        if ($request->isMethod('POST') && in_array($nextstep, [1,2,3])) {
            $entity->setStep($nextstep);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute(
            $redirects[$nextstep-1],
            ['id' => $entity->getId()]
        );
    }

    /**
     * Creates a new tournament entity.
     *
     * @Route("/new", name="app_tournament_new")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function newAction(Request $request)
    {
        $logger = $this->get('logger');
        $avatar = $this->get('app.avatar.tournament');
        $entity = new Tournament();
        $form = $this->getForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $conn = $manager->getConnection();
            $conn->beginTransaction();
            try {
                $avatar->setAvatar($entity);
                $manager->persist($entity->setUser($this->getUser()));
                $manager->flush();
                $conn->commit();
                $this->addFlash("status", "Torneo creado Exitosamente");
                return $this->redirectToRoute("app_tournament_index");
            } catch (\Exception $e) {
                $conn->rollback();
                $this->addFlash("status", "Error al crear el torneo");
                $logger->critical("[Torneo create] ".$e->getMessage());
            }
        }

        return array(
            "require_add_team" => False,
            "form"=>$form->createView(),
            "entity" => $entity
        );

    }

    /**
     * Displays a form to edit an existing equipo entity.
     *
     * @Route("/{id}/edit", name="app_tournament_edit")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function editAction(Request $request, Tournament $entity)
    {
        if ($entity->getStep()!= 1) {
            return $this->redirectToRoute('app_tournament_step', [
                'id' => $entity->getId(),
                'nextstep' => $entity->getStep()
            ]);
        }

        $avatar = $this->get('app.avatar.tournament');
        $logger = $this->get('logger');
        $manager = $this->getDoctrine()->getManager();
        $currentAvatar = $entity->getImage();
        if (is_string($entity->getImage())) {
            $entity->setImage(new File($entity->getImage()));
        }
        $form = $this->getForm($entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                if ($entity->getTournamentType()->getAction() == 'groups') {
                    $entity->setPlayoffMatchModality(null)->getPlayoffInstance(null);
                } elseif ($entity->getTournamentType()->getAction() == 'playoff') {
                    $entity->setTeamsPerGroups(null)->setQualifiedTeams(null)->setGroupMatchModality(null);
                }
                $avatar->setAvatar($entity);
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash("status", "Torneo modificado Exitosamente");
                if ($currentAvatar) {
                    @unlink($currentAvatar);
                }
                return $this->redirectToRoute('app_tournament_index');
            } catch (\Exception $e) {
                $this->addFlash("status", "Error al modificar el torneo");
                dump($e->getMessage());
                $logger->critical("[Torneo update] ".$e->getMessage());
            }
        }

        return array(
            "require_add_team" => True,
            "form" => $form->createView(),
            "entity" => $entity
        );
    }

    /**
     * Displays a form to edit an existing equipo entity.
     *
     * @Route("/{id}/add-teams", name="app_tournament_add_team")
     * @Route("/{id}/add-teams/{ttid}/team", name="app_tournament_add_team_remove")
     * @Method({"GET", "POST", "DELETE"})
     * @Template
     */
    public function addTeamAction(Request $request, Tournament $entity, $ttid = null)
    {
        $manager = $this->getDoctrine()->getManager();
        $teamRepo = $manager->getRepository(Team::class);
        $tournamentTeamRepo = $manager->getRepository(TournamentTeam::class);
        $teams = [];

        if ($entity->getStep()!= 2) {
            return $this->redirectToRoute('app_tournament_step', [
                'id' => $entity->getId(),
                'nextstep' => $entity->getStep()
            ]);
        }

        if ($request->isMethod('POST')) {
            $teamName = $request->request->get('team_name');
            if (!$team = $teamRepo->findOneBy(['name'=>$teamName])) {
                $request->getSession()->set('team_name', $teamName);
                return $this->redirectToRoute('app_team_new_tournament', [
                    'id' => $entity->getId(),
                ]);
            }
            $tournamentTeam = new TournamentTeam();
            $entity->addTournamentTeam($tournamentTeam->setTeam($team));
            $manager->persist($entity);
            $manager->flush();
            return $this->redirectToRoute('app_tournament_add_team', [
                'id' => $entity->getId(),
            ]);
        }
        if ($request->isMethod('DELETE')) {
            if ($tournamentTeam = $tournamentTeamRepo->find($ttid)) {
                $manager->remove($tournamentTeam);
                $manager->flush();
                return $this->redirectToRoute('app_tournament_add_team', [
                    'id' => $entity->getId(),
                ]);
            }
        }

        $tournamentTeamIds = [];
        foreach ($entity->getTournamentTeams() as $tournamentTeam) {
            $tournamentTeamIds[] = $tournamentTeam->getTeam()->getId();
        }

        foreach ($teamRepo->findAll() as $team) {
            if (!in_array($team->getId(), $tournamentTeamIds)) {
                $teams[] = $team->getName();
            }
        }

        return [
            'entity' => $entity,
            'teams' => $teams
        ];
    }

    /**
     * Displays a form to edit an existing equipo entity.
     *
     * @Route("/{id}/generate", name="app_tournament_generate")
     * @Method("GET")
     */
    public function generateAction(Request $request, Tournament $entity)
    {
        $manager = $this->getDoctrine()->getManager();

        if ($entity->getStep() != 3) {
            throw $this->createNotFoundException();
        }

        if ($entity->getTournamentType()->getAction() == 'groups') {
            $groups = ['A','B','C','D','E','F','G','H','I','J','K',];
            $tournamentTeams = $entity->getTournamentTeams()->toArray();
            shuffle($tournamentTeams);
            $tournamentTeamGroups = array_chunk($tournamentTeams, $entity->getTeamsPerGroups());

            foreach ($tournamentTeamGroups as $key => $tournamentTeams) {
                foreach ($tournamentTeams as $index => $tournamentTeam) {
                    $tournamentTeam->setGroup($groups[$key]);
                    $tournamentTeam->setNumber($index+1);
                    $manager->persist($tournamentTeam);
                }
                $fixtures = new GroupFixture(
                    $tournamentTeams,
                    $entity->getGroupMatchModality() != MatchTypeStaticChoice::ROUND_TRIP
                );

                foreach ($fixtures->getFixturesByJournal() as $key => $round) {
                    foreach ($round as $teams) {
                        $game = (new TournamentGame())
                            ->setMatchTime(MatchTimeStaticChoice::TWO_TIMES_45_MINUTES)
                            ->setHomeTeam($teams[0])
                            ->setVisitTeam($teams[1])
                            ->setRound($key+1)
                            ->setRoundType(1)
                        ;
                        $manager->persist($game);
                    }
                }
            }
            $manager->persist($entity->setStep(4));
            $manager->flush();

            $this->addFlash('status','La generación de los emparejamientos exitosa!!');
            return $this->redirectToRoute('app_tournament_show', ['id' => $entity->getId()]);
        }
        $this->addFlash('status','La generación de los emparejamientos esta en desarrollo');
        return $this->redirectToRoute('app_tournament_index');
    }

    /**
     * Displays a form to edit an existing equipo entity.
     *
     * @Route("/{id}/show", name="app_tournament_show")
     * @Route("/{id}/show/{viewtype}", name="app_tournament_show_viewtype")
     * @Method("GET")
     * @Template
     */
    public function showAction(Request $request, Tournament $entity, $viewtype = null)
    {
        $view = $viewtype ? 'ViewType' :'';
        $manager = $this->getDoctrine()->getManager();
        if ($entity->getStep() != 4) {
            throw $this->createNotFoundException();
        }
        $gameList = [];
        if ($viewtype == 'dates') {
            $repo = $manager->getRepository(TournamentGame::class);
            foreach ($repo->gameByRound($entity) as $game) {
                if (!isset($gameList[$game->getRound()])) {
                    $gameList[$game->getRound()] = [];
                }
                $gameList[$game->getRound()][] = $game;
            }
        } elseif ($viewtype == 'groups') {
            $repo = $manager->getRepository(TournamentTeam::class);
            foreach ($repo->teamByGroup($entity) as $game) {
                if (!isset($gameList[$game->getGroup()])) {
                    $gameList[$game->getGroup()] = [];
                }
                $gameList[$game->getGroup()][] = $game;
            }
        } elseif ($viewtype == 'fixtures') {
            $repo = $manager->getRepository(TournamentGame::class);
            foreach ($repo->gameByGroup($entity) as $game) {
                if (!isset($gameList[$game->getHomeTeam()->getGroup()])) {
                    $gameList[$game->getHomeTeam()->getGroup()] = [];
                }
                $gameList[$game->getHomeTeam()->getGroup()][] = $game;
            }
        }

        return $this->render("AppBundle:Tournament:show$view.html.twig", [
            'entity' => $entity,
            'viewtype' => $viewtype,
            'gameList' => $gameList
        ]);
    }

    private function getForm(Tournament $tournament)
    {
        return $this->createForm(TournamentType::class, $tournament);
    }
}
