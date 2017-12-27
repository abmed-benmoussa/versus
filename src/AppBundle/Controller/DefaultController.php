<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function homeAction(Request $request)
    {
        return $this->render('AppBundle:Default:home.html.twig');
    }
  public function menuIndexAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/menuIndex.html.twig');
  }

  public function indexAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/index.html.twig');
  }
  public function olvidoContrasenaAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/olvidoContrasena.html.twig');
  }

  public function conectarCuentasAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/conectarCuentas.html.twig');
  }
  public function conectarFacebookAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/conectarFacebook.html.twig');
  }
  public function conectarTwitterAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/conectarTwitter.html.twig');
  }
  public function conectarInstagramAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/conectarInstagram.html.twig');
  }
  public function selectMailAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/selectMail.html.twig');
  }
  public function conectarGoogleAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/conectarGoogle.html.twig');
  }
  public function conectarOutlookAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/conectarOutlook.html.twig');
  }
  public function conectarYahooAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/conectarYahoo.html.twig');
  }
  public function misTorneosAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/misTorneos.html.twig');
  }
  public function SuccessFacebookAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/successFacebook.html.twig');
  }
  public function DangerFacebookAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/dangerFacebook.html.twig');
  }
  public function SuccessTwitterAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/successTwitter.html.twig');
  }
  public function DangerTwitterAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/dangerTwitter.html.twig');
  }
  public function SuccessInstagramAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/successInstagram.html.twig');
  }
  public function DangerInstagramAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/dangerInstagram.html.twig');
  }
  public function SuccessGoogleAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/successGoogle.html.twig');
  }
  public function DangerGoogleAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/dangerGoogle.html.twig');
  }
  public function SuccessOutlookAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/successOutlook.html.twig');
  }
  public function DangerOutlookAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/dangerOutlook.html.twig');
  }
  public function SuccessYahooAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/successYahoo.html.twig');
  }
  public function DangerYahooAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/dangerYahoo.html.twig');
  }
  public function conexionCuentasAction()
  {
      return $this->render('AppBundle:Default:1_2_inicio/conexionCuentas.html.twig');
  }
  /*-----------------------CARPETA 3_crearTorneo------------------------------*/
  public function crearTorneoAction()
  {
      return $this->render('AppBundle:Default:3_crearTorneo/crearTorneo.html.twig');
  }
  public function infoEquiposAction()
  {
      return $this->render('AppBundle:Default:3_crearTorneo/infoEquipos.html.twig');
  }
  public function cargaEquiposAction()
  {
      return $this->render('AppBundle:Default:3_crearTorneo/cargaEquipos.html.twig');
  }
  /*-----------------------CARPETA 4_previsualizaTorneo------------------------------*/
  public function IndexFichaTorneoAction()
  {
      return $this->render('AppBundle:Default:4_previsualizaTorneo/indexFichaTorneo.html.twig');
  }
  public function FichaPorFechasAction()
  {
      return $this->render('AppBundle:Default:4_previsualizaTorneo/fichaPorFechas.html.twig');
  }
  public function FichaPorGruposAction()
  {
      return $this->render('AppBundle:Default:4_previsualizaTorneo/fichaPorGrupos.html.twig');
  }
  public function FichaPorFixtureAction()
  {
      return $this->render('AppBundle:Default:4_previsualizaTorneo/fichaPorFixture.html.twig');
  }
  public function FichaPorFixture2Action()
  {
      return $this->render('AppBundle:Default:4_previsualizaTorneo/fichaPorFixture2.html.twig');
  }
  public function FichaPorFixture3Action()
  {
      return $this->render('AppBundle:Default:4_previsualizaTorneo/fichaPorFixture3.html.twig');
  }
  public function datosJugadorAction()
  {
      return $this->render('AppBundle:Default:3_crearTorneo/datosJugador.html.twig');
  }
  public function FichaPorFechas2Action()
  {
      return $this->render('AppBundle:Default:4_previsualizaTorneo/fichaPorFechas2.html.twig');
  }
  public function FichaPorGrupos2Action()
  {
      return $this->render('AppBundle:Default:4_previsualizaTorneo/fichaPorGrupos2.html.twig');
  }
  public function tableroTorneo2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/tableroTorneo2.html.twig');
  }
  public function compartirPosicionesAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirPosiciones.html.twig');
  }
  public function compartirGoleadoresAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirGoleadores.html.twig');
  }
  public function compartirExpulAmonestacinesAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirExpulAmonestacines.html.twig');
  }
  public function compartirAsistenciasAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirAsistencias.html.twig');
  }
  public function compartirTablasAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirTablas.html.twig');
  }
  public function compartirEstadisticasAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirEstadisticas.html.twig');
  }
  public function compartirFacebookAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirFacebook.html.twig');
  }
  public function compartirTwitterAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirTwitter.html.twig');
  }
  public function compartirInstagramAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirInstagram.html.twig');
  }
  public function compartirMailAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/compartirMail.html.twig');
  }
  public function partidosPostergadosAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo2/partidosPostergados.html.twig');
  }
   public function miCuentaAction()
  {
      return $this->render('AppBundle:Default:6_mi_cuenta/miCuenta.html.twig');
  }
  public function tableroTorneoAction()
  {
      return $this->render('AppBundle:Default:6_mi_cuenta/tableroTorneo.html.twig');
  }
  public function partidosJugadosAction()
  {
      return $this->render('AppBundle:Default:6_mi_cuenta/partidosJugados.html.twig');
  }
  //CARPETA 5_tablero_torne01
  public function tableroTorneo3Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneo3.html.twig');
  }
  public function tablaPosicionesAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tablaPosiciones.html.twig');
  }
  public function TableroTorneoGrupos2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoGrupos2.html.twig');
  }
   public function TableroTorneoLista2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoLista2.html.twig');
  }
  public function TableroTorneoFechas2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoFechas2.html.twig');
  }
  public function TableroTorneoPlayoof3Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoPlayoof3.html.twig');
  }
  public function TableroTorneoPlayoof4Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoPlayoof4.html.twig');
  }
  public function TableroTorneoPlayoofF2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoPlayoofF2.html.twig');
  }
   public function TableroTorneoGruposAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoGrupos.html.twig');
  }
   public function TableroTorneoListaAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoLista.html.twig');
  }
  public function TableroTorneoFechasAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoFechas.html.twig');
  }
  public function TableroTorneoCombinadoAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoCombinado.html.twig');
  }
  public function TableroTorneoPlayoof1Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoPlayoof1.html.twig');
  }
  public function TableroTorneoPlayoof2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoPlayoof2.html.twig');
  }
  public function TableroTorneoPlayoofFAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tableroTorneoPlayoofF.html.twig');
  }
  public function DetallePartido1Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/detallePartido1.html.twig');
  }

  public function DetallePartido2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/detallePartido2.html.twig');
  }

  public function EstadisticasJugadorAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/estadisticasJugador.html.twig');
  }
    public function DetallePartido3Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/detallePartido3.html.twig');
  }
    public function CompartirPartidoAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/compartirPartido.html.twig');
  }

    public function SelectCompartirAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/selectCompartir.html.twig');
  }

    public function CompartirFacebook2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/compartirFacebook2.html.twig');
  }

    public function FechaHorariosAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/fechaHorarios.html.twig');
  }

    public function FechaHorarios2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/fechaHorarios2.html.twig');
  }

     public function DireccionPartidosAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/direccionPartidos.html.twig');
  }

     public function TablaGoleadoresAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tablaGoleadores.html.twig');
  }

     public function TablaAsistenciasAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tablaAsistencias.html.twig');
  }

     public function TablaExpulsionesAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/tablaExpulsiones.html.twig');
  }

     public function ProximasFechas1Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/proximasFechas1.html.twig');
  }
     public function ProximasFechas2Action()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/proximasFechas2.html.twig');
  }
     public function NovedadesTorneoAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/novedadesTorneo.html.twig');
  }
  //carpeta
  public function resultadoPartidoAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/resultadoPartido.html.twig');
  }
  public function golesAnotadosAction()
  {
      return $this->render('AppBundle:Default:6_mi_cuenta/golesAnotados.html.twig');
  }
  public function asistenciasAction()
  {
      return $this->render('AppBundle:Default:6_mi_cuenta/asistencias.html.twig');
  }
  public function tarjetasAction()
  {
      return $this->render('AppBundle:Default:6_mi_cuenta/tarjetas.html.twig');
  }
  public function atajadasAction()
  {
      return $this->render('AppBundle:Default:6_mi_cuenta/atajadas.html.twig');
  }
  public function consolidadaAction()
  {
      return $this->render('AppBundle:Default:6_mi_cuenta/consolidada.html.twig');
  }
  public function detallePartidoAction()
  {
      return $this->render('AppBundle:Default:5_tablero_torneo1/detallePartido1.html.twig');
  }
}
