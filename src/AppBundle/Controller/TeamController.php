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

use BackendBundle\Entity\Team;
use BackendBundle\Entity\Tournament;
use BackendBundle\Entity\TournamentTeam;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TeamType;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Equipo controller.
 *
 * @Route("equipos")
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class TeamController extends Controller
{
    /**
     * Lists all equipo entities.
     *
     * @Route("/", name="app_team_index")
     * @Route("/{id}/torneo", name="app_team_tournament_index")
     * @Method("GET")
     * @Template
     */
    public function indexAction(Request $request, Tournament $tournament = null)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository(Team::class);
        $paginator = $this->get('knp_paginator');

        return ['pagination' => $paginator->paginate(
            $repo->findByTournamentQuery($tournament),
            $request->query->get('page', 1),
            6
        )];
    }

    /**
     * Creates a new equipo entity.
     *
     * @Route("/new", name="app_team_new")
     * @Route("/new/{id}/torneo", name="app_team_new_tournament")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function newAction(Request $request, Tournament $tournament = null)
    {
        $logger = $this->get('logger');
        $avatar = $this->get('app.avatar.team');
        $session = $request->getSession();
        $entity = new Team();
        if ($tournament) {
            $entity->setName($session->get('team_name'));
        }
        $form = $this->createForm(TeamType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $conn = $manager->getConnection();
            $conn->beginTransaction();
            try {
                $avatar->setAvatar($entity);
                if ($tournament) {
                    $tournamentTeam = new TournamentTeam();
                    $entity->addTournamentTeam($tournamentTeam->setTournament($tournament));
                }
                $this->bulkloadProcess($entity);
                $manager->persist($entity->setUser($this->getUser()));
                $manager->flush();
                $conn->commit();
                $this->addFlash("status", "Equipo creado Exitosamente");
                if ($tournament) {
                    return $this->redirectToRoute('app_tournament_add_team', [
                        'id' => $tournament->getId()
                    ]);
                }
                return $this->redirectToRoute('app_team_edit', array('id' => $entity->getId()));
            } catch (\Exception $e) {
                $conn->rollback();
                $this->addFlash("status", "Error al crear el equipo");
                $logger->critical("[Team create] ".$e->getMessage());
            }
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing equipo entity.
     *
     * @Route("/{id}/edit", name="app_team_edit")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function editAction(Request $request, Team $entity)
    {
        $logger = $this->get('logger');
        $avatar = $this->get('app.avatar.team');
        $manager = $this->getDoctrine()->getManager();
        if (is_string($currentAvatar = $entity->getImage())) {
            $entity->setImage(new File($currentAvatar));
        }
        $form = $this->createForm(TeamType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->bulkloadProcess($entity);
                $avatar->setAvatar($entity, $currentAvatar);
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash("status", "Equipo modificado Exitosamente");
                return $this->redirectToRoute('app_team_index');
            } catch (\Exception $e) {
                $this->addFlash("status", "Error al modificar el equipo");
                $logger->critical("[Team update] ".$e->getMessage());
                var_dump($e); exit;
            }
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Deletes a equipo entity.
     *
     * @Route("/{id}", name="app_team_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Team $entity)
    {
        $form = $this->createDeleteForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirectToRoute('app_team_index');
    }

    private function bulkloadProcess(Team $entity)
    {
        $bulkload = $this->get('app.bulkload.player');
        $bulkload->importProcess($entity);
    }
    /**
     * Creates a form to delete a equipo entity.
     *
     * @param Team $entity The equipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Team $entity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_team_delete', array('id' => $entity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
