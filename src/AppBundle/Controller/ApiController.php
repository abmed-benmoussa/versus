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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use BackendBundle\Entity\TournamentType;
/**
 * @Route("/api")
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class ApiController extends Controller
{
    /**
     * @Route("/tournament-type/{id}/action", name="api_tournament_type_action")
     * @Method("GET")
     */
    public function tournamentTypeAction(Request $request, TournamentType $tournamentType)
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createNotFoundException();
        }

        return new JsonResponse(array("action" => $tournamentType->getAction()));
    }

    /**
     * Bulkload Template of neighbour data.
     *
     * @Route("/bulk-load/{name}/template", name="api_bulkload_template")
     * @Method("GET")
     */
    public function bulkLoadTemplateAction(Request $request, $name)
    {
        $service = $this->get("app.bulkload.$name");
        return $this->file($service->getBulkLoadTemplate());
    }

}
