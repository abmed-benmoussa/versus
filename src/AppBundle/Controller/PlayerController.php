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

use BackendBundle\Entity\Player;
use AppBundle\Model\Player as PlayerModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Form\PlayerType;

/**
 * @Route("/player")
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class PlayerController extends Controller
{
    /**
     * Lists all tournaments entities.
     *
     * @Route("/", name="app_player_index")
     * @Method("GET")
     * @Template
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Player:index.html.twig');    
    }

    /**
     * Despliego un form de consulta de partidos jugados
     *
     * @Route("/showPartidosJugados/{id}", name="app_player_pj")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function showPartidosJugadosAction(Request $request)
    {
        return $this->render('AppBundle:Default:6_mi_cuenta/partidosJugados.html.twig');    
    }

    /**
     * Despliego un form de consulta de goles anotados
     *
     * @Route("/showGolesAnotados/{id}", name="app_player_ga")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function showGolesAnotadosAction(Request $request)
    {
        return $this->render('AppBundle:Default:6_mi_cuenta/golesAnotados.html.twig');   
    }

    /**
     * Despliego un form de consulta de asistencias
     *
     * @Route("/showAsistencias/{id}", name="app_player_as")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function showAsistenciasAction(Request $request)
    {
        return $this->render('AppBundle:Default:6_mi_cuenta/asistencias.html.twig');
    }

    /**
     * Despliego un form de consulta de tarjetas
     *
     * @Route("/showTarjetas/{id}", name="app_player_tra")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function showTarjetasAction(Request $request)
    {
        return $this->render('AppBundle:Default:6_mi_cuenta/tarjetas.html.twig');    
    }

    /**
     * Despliego un form de consulta de atajadas
     *
     * @Route("showAtajadas/{id}", name="app_player_ata")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function showAtajadasAction(Request $request)
    {
        return $this->render('AppBundle:Default:6_mi_cuenta/atajadas.html.twig');    
    }

    /**
     * Despliego un form de consulta de tabla consolidada
     *
     * @Route("/showTablaConsolidada/{id}", name="app_player_vtc")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function showTablaConsolidadaAction(Request $request)
    {
        return $this->render('AppBundle:Default:6_mi_cuenta/consolidada.html.twig');    
    }

    /**
     * @Route("/{id}/edit", name="app_player_edit")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function editAction(Request $request, Player $entity)
    {
        $logger = $this->get('logger');
        // $userManager = $this->get('app.manager.user_manager');
        $manager = $this->getDoctrine()->getManager();
        list($player, $currentAvatar) = $this->getPlayer($entity);
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->updatePlayer($entity, $player, $currentAvatar);
                // $this->getDoctrine()->getManager()->flush();
                $this->addFlash("status", "Jugador modificado Exitosamente");
                return new JsonResponse([]);
            } catch (\Exception $e) {
                var_dump($e);
                $logger->critical("[Team update] ".$e->getMessage());
            }
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    private function updatePlayer(Player $entity, PlayerModel $model, $currentAvatar)
    {
        $avatar = $this->get('app.avatar.profile');
        $manager = $this->get('app.manager.user_manager');
        $user = $entity->getUser()->setImage($model->image);
        $item = new \AppBundle\Library\Item\PlayerItem([
            $model->document,
            $model->firstName,
            $model->lastName,
            $model->birthday,
            $model->email,
            $model->phoneNumber,
            $model->positions->toArray(),
            $model->shirtNumber,
            $model->isCaptain,
        ]);
        $avatar->setAvatar($user, $currentAvatar);
        $manager->createOrUpdatePlayer($entity->getTeam(), $item, $model->positions->toArray());
        $this->getDoctrine()->getManager()->flush();
    }

    private function getPlayer(Player $entity)
    {
        $user = $entity->getUser();
        $model = new PlayerModel;

        $model->firstName = $user->getFirstName();
        $model->lastName = $user->getLastName();
        $model->birthday = $user->getBirthday();
        $model->email = $user->getEmail();
        $model->document = $user->getDocument();
        $model->phoneNumber = $user->getPhoneNumber();
        $model->positions = $user->getPlayerPositions();
        $model->shirtNumber = $entity->getShirtNumber();
        $model->isCaptain = $entity->getIsCaptain();

        if (is_string($currentAvatar = $user->getImage())) {
            $model->image =new File($currentAvatar);
        }

        return [$model, $currentAvatar];
    }

    private function getPositions(array $positions)
    {
        $repo = $this->getRepo('PlayerPosition');
        return array_filter(array_map(function($acronym) use ($repo) {
            return $repo->findOneBy(['acronym' => $acronym, 'status' => 1]);
        }, $positions));
    }
}
