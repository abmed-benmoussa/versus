<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use BackendBundle\Entity\Equipos;
use BackendBundle\Entity\Torneos;
use BackendBundle\Entity\Jugadores;
use AppBundle\Form\JugadoresType;
use AppBundle\Form\EquiposType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Doctrine\ORM\EntityManager;

class JugadoresController extends Controller {

	private $session;

	public function __construct() {
		$this->session = new Session();
	}

	public function crearjugadoresAction(Request $request,$id) {
		$jugadores = new Jugadores();
		//$equipo=$id;
		$form = $this->createForm(JugadoresType::class, $jugadores);
		/*
		$form = $this->createForm(JugadoresType::class, $equipo, array(
			'empty_data' => $torneo
			));
		*/	
		$form->handleRequest($request);

		if ($form->isSubmitted()) {
			if ($form->isValid()) {

				$em = $this->getDoctrine()->getManager();
				$em->persist($equipo);
				$flush = $em->flush();

					if ($flush == null) {
						$status = "Equipo registrado correctamente";

						$this->session->getFlashBag()->add("status", $status);
						return $this->redirectToRoute("app_tournament_index");

					} else {
						$status = "No se registro equipo";
					}

			} else {
				$status = "No se registro equipo";
			}

			$this->session->getFlashBag()->add("status", $status);
		}

		return $this->render('AppBundle:Jugadores:cargarequipos.html.twig', array(
					"form" => $form->createView()
		));

    }

	public function verequiposAction(Request $request, $id) {
		$em=$this->getDoctrine()->getManager();
        $dql="Select e from BackendBundle:Equipos e
			  where e.torneos = :torneos";
		$query=$em->createQuery($dql);
		$query->setParameter('torneos', $id);

		//$pagination = $query->getResult();

		//var_dump ($pagination); exit;

		$paginator=$this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page',1),6);
			
        return $this->render('AppBundle:Equipos:ver.html.twig', array(
            'pagination'=>$pagination
        ));
	}

	public function cargarequiposAction(Request $request,$id) {
		$em = $this->getDoctrine()->getManager();
		$equipos_repo=$em->getRepository("BackendBundle:Equipos");
		$equipo=$equipos_repo->find($id);
		$form = $this->createForm(JugadoresType::class, $equipo);

		$form->handleRequest($request);
		if ($form->isSubmitted()) {
			if ($form->isValid()) {
				$em->persist($torneo);
				$flush = $em->flush();

					if ($flush == null) {
						$status = "Se carga archivo";

						$this->session->getFlashBag()->add("status", $status);

					} else {
						$status = "No se carga archivo";
					}

			} else {
				$status = "No se carga archivo";
			}
			return $this->redirectToRoute("app_tournament_index");
		}


		return $this->render('AppBundle:Equipo:cargaequipos.html.twig', array(
					"form" => $form->createView()
		));
    }


	public function editarequiposAction(Request $request,$id) {
		$em = $this->getDoctrine()->getManager();
		$equipos_repo=$em->getRepository("BackendBundle:Equipos");
		$equipo=$equipos_repo->find($id);
		$form = $this->createForm(EquiposmType::class, $equipo);

		$form->handleRequest($request);
		if ($form->isSubmitted()) {
			if ($form->isValid()) {
				$em->persist($equipo);
				$flush = $em->flush();

					if ($flush == null) {
						$status = "Se actualiza equipo";

						$this->session->getFlashBag()->add("status", $status);

					} else {
						$status = "No se actualiza equipo";
					}

			} else {
				$status = "No se actualiza equipo";
			}
			return $this->redirectToRoute("app_tournament_index");
		}


		return $this->render('AppBundle:Equipos:informacionequipos.html.twig', array(
					"form" => $form->createView()
		));
    }

	public function informacionequiposAction(Request $request) {
	        return $this->render('AppBundle:Equipos:informacionequipos.html.twig');
	}
}
