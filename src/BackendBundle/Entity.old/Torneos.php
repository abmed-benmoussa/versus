<?php

namespace BackendBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
#use Vich\UploaderBundle\Mapping\PropertyMapping as Vich;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

/**
 *
 *
 * @ORM\Table(name="torneos")
 * @ORM\Entity
 * @Vich\Uploadable
 */

class Torneos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var \DateTime
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     */
    private $fechaFinal;

    /**
     * @var integer
     */
    private $diasJugar;

    /**
     * @var integer
     */
    private $partidosDia;

    /**
     * @var integer
     */
    private $duracionPartido;

    /**
     * @var \DateTime
     */
    private $horario;

    /**
     * @var integer
     */
    private $numeroEquipos;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $logo;

    /**
     * @Vich\UploadableField(mapping="torneo_images", fileNameProperty="logo")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $end;

    /**
     * @var \BackendBundle\Entity\Tipotorneos
     */
    private $tipotorneos;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $user;

    /**
     * @var \BackendBundle\Entity\Equipos[]
     */
    private $equipos;
    /**
     * @var integer
     */
    private $numeroGrupos;

    /**
     * @var integer
     */
    private $equiposGrupos;

    /**
     * @var integer
     */
    private $equiposClasifican;

    /**
     * @var string
     */
    private $partidosIdavuelta;

    /**
     * @var string
     */
    private $partidosUnicoidavuelta;

    /**
     * @var string
     */
    private $playoffInstancia;

    /**
     * @var integer
     */
    private $numeroGruposcombinado;

    /**
     * @var integer
     */
    private $equiposGruposcombinado;

    /**
     * @var integer
     */
    private $equiposClasificancombinado;

    /**
     * @var string
     */
    private $partidosIdavueltacombinado;


    /**
     * @var string
     */
    private $partidosUnicoidavueltaplayoff;

    /**
     * @var string
     */
    private $playoffInstanciaplayoff;

    /**
     * @var string
     */
    private $latLng;



    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Torneos
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Torneos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Torneos
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     *
     * @return Torneos
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set diasJugar
     *
     * @param integer $diasJugar
     *
     * @return Torneos
     */
    public function setDiasJugar($diasJugar)
    {
        $this->diasJugar = $diasJugar;

        return $this;
    }

    /**
     * Get diasJugar
     *
     * @return integer
     */
    public function getDiasJugar()
    {
        return $this->diasJugar;
    }

    /**
     * Set partidosDia
     *
     * @param integer $partidosDia
     *
     * @return Torneos
     */
    public function setPartidosDia($partidosDia)
    {
        $this->partidosDia = $partidosDia;

        return $this;
    }

    /**
     * Get partidosDia
     *
     * @return integer
     */
    public function getPartidosDia()
    {
        return $this->partidosDia;
    }

    /**
     * Set duracionPartido
     *
     * @param integer $duracionPartido
     *
     * @return Torneos
     */
    public function setDuracionPartido($duracionPartido)
    {
        $this->duracionPartido = $duracionPartido;

        return $this;
    }

    /**
     * Get duracionPartido
     *
     * @return integer
     */
    public function getDuracionPartido()
    {
        return $this->duracionPartido;
    }

    /**
     * Set horario
     *
     * @param \DateTime $horario
     *
     * @return Torneos
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return \DateTime
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set numeroEquipos
     *
     * @param integer $numeroEquipos
     *
     * @return Torneos
     */
    public function setNumeroEquipos($numeroEquipos)
    {
        $this->numeroEquipos = $numeroEquipos;

        return $this;
    }

    /**
     * Get numeroEquipos
     *
     * @return integer
     */
    public function getNumeroEquipos()
    {
        return $this->numeroEquipos;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Torneos
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    public function setImageFile(File $logo = null){
      $this->imageFile = $logo;

      // VERY IMPORTANT:
      // It is required that at least one field changes if you are using Doctrine,
      // otherwise the event listeners won't be called and the file is lost
      if ($logo) {
          // if 'updatedAt' is not defined in your entity, use another property
          $this->updatedAt = new \DateTime('now');
      }
    }

    public function getImageFile(){
      return $this->imageFile;
    }


    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Torneos
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Schedule
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }


    /**
     * Set tipotorneos
     *
     * @param \BackendBundle\Entity\Tipotorneos $tipotorneos
     *
     * @return Torneos
     */
    public function setTipotorneos(\BackendBundle\Entity\Tipotorneos $tipotorneos = null)
    {
        $this->tipotorneos = $tipotorneos;

        return $this;
    }

    /**
     * Get tipotorneos
     *
     * @return \BackendBundle\Entity\Tipotorneos
     */
    public function getTipotorneos()
    {
        return $this->tipotorneos;
    }



    /**
     * Set user
     *
     * @param \BackendBundle\Entity\User $user
     *
     * @return Torneos
     */
    public function setUser(\BackendBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BackendBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }



        /**
         * Set numeroGrupos
         *
         * @param integer $numeroGrupos
         *
         * @return Torneos
         */
        public function setNumeroGrupos($numeroGrupos)
        {
            $this->numeroGrupos = $numeroGrupos;

            return $this;
        }

        /**
         * Get numeroGrupos
         *
         * @return integer
         */
        public function getNumeroGrupos()
        {
            return $this->numeroGrupos;
        }


        /**
         * Set equiposGrupos
         *
         * @param integer $equiposGrupos
         *
         * @return Torneos
         */
        public function setEquiposGrupos($equiposGrupos)
        {
            $this->equiposGrupos = $equiposGrupos;

            return $this;
        }

        /**
         * Get equiposGrupos
         *
         * @return integer
         */
        public function getEquiposGrupos()
        {
            return $this->equiposGrupos;
        }


        /**
         * Set equiposClasifican
         *
         * @param integer $equiposClasifican
         *
         * @return Torneos
         */
        public function setEquiposClasifican($equiposClasifican)
        {
            $this->equiposClasifican = $equiposClasifican;

            return $this;
        }

        /**
         * Get equiposClasifican
         *
         * @return integer
         */
        public function getEquiposClasifican()
        {
            return $this->equiposClasifican;
        }

        /**
         * Set partidosIdavuelta
         *
         * @param string $partidosIdavuelta
         *
         * @return Torneos
         */
        public function setPartidosIdavuelta($partidosIdavuelta)
        {
            $this->partidosIdavuelta = $partidosIdavuelta;

            return $this;
        }

        /**
         * Get partidosIdavuelta
         *
         * @return string
         */
        public function getPartidosIdavuelta()
        {
            return $this->partidosIdavuelta;
        }

        /**
         * Set partidosUnicoidavuelta
         *
         * @param string $partidosUnicoidavuelta
         *
         * @return Torneos
         */
        public function setPartidosUnicoidavuelta($partidosUnicoidavuelta)
        {
            $this->partidosUnicoidavuelta = $partidosUnicoidavuelta;

            return $this;
        }

        /**
         * Get partidosUnicoidavuelta
         *
         * @return string
         */
        public function getPartidosUnicoidavuelta()
        {
            return $this->partidosUnicoidavuelta;
        }



        /**
         * Set playoffInstancia
         *
         * @param string $playoffInstancia
         *
         * @return Torneos
         */
        public function setPlayoffInstancia($playoffInstancia)
        {
            $this->playoffInstancia = $playoffInstancia;

            return $this;
        }

        /**
         * Get playoffInstancia
         *
         * @return string
         */
        public function getPlayoffInstancia()
        {
            return $this->playoffInstancia;
        }












        /**
         * Set numeroGruposcombinado
         *
         * @param integer $numeroGruposcombinado
         *
         * @return Torneos
         */
        public function setNumeroGruposcombinado($numeroGruposcombinado)
        {
            $this->numeroGruposcombinado = $numeroGruposcombinado;

            return $this;
        }

        /**
         * Get numeroGruposcombinado
         *
         * @return integer
         */
        public function getNumeroGruposcombinado()
        {
            return $this->numeroGruposcombinado;
        }


        /**
         * Set equiposGruposcombinado
         *
         * @param integer $equiposGruposcombinado
         *
         * @return Torneos
         */
        public function setEquiposGruposcombinado($equiposGruposcombinado)
        {
            $this->equiposGruposcombinado = $equiposGruposcombinado;

            return $this;
        }

        /**
         * Get equiposGruposcombinado
         *
         * @return integer
         */
        public function getEquiposGruposcombinado()
        {
            return $this->equiposGruposcombinado;
        }


        /**
         * Set equiposClasificancombinado
         *
         * @param integer $equiposClasificancombinado
         *
         * @return Torneos
         */
        public function setEquiposClasificancombinado($equiposClasificancombinado)
        {
            $this->equiposClasificancombinado = $equiposClasificancombinado;

            return $this;
        }

        /**
         * Get equiposClasificancombinado
         *
         * @return integer
         */
        public function getEquiposClasificancombinado()
        {
            return $this->equiposClasificancombinado;
        }

        /**
         * Set partidosIdavueltacombinado
         *
         * @param string $partidosIdavueltacombinado
         *
         * @return Torneos
         */
        public function setPartidosIdavueltacombinado($partidosIdavueltacombinado)
        {
            $this->partidosIdavueltacombinado = $partidosIdavueltacombinado;

            return $this;
        }

        /**
         * Get partidosIdavueltacombinado
         *
         * @return string
         */
        public function getPartidosIdavueltacombinado()
        {
            return $this->partidosIdavueltacombinado;
        }


         /**
         * Set partidosUnicoidavueltaplayoff
         *
         * @param string $partidosUnicoidavueltaplayoff
         *
         * @return Torneos
         */
        public function setPartidosUnicoidavueltaplayoff($partidosUnicoidavueltaplayoff)
        {
            $this->partidosUnicoidavueltaplayoff = $partidosUnicoidavueltaplayoff;

            return $this;
        }

        /**
         * Get partidosUnicoidavueltaplayoff
         *
         * @return string
         */
        public function getPartidosUnicoidavueltaplayoff()
        {
            return $this->partidosUnicoidavueltaplayoff;
        }



        /**
         * Set playoffInstanciaplayoff
         *
         * @param string $playoffInstanciaplayoff
         *
         * @return Torneos
         */
        public function setPlayoffInstanciaplayoff($playoffInstanciaplayoff)
        {
            $this->playoffInstanciaplayoff = $playoffInstanciaplayoff;

            return $this;
        }

        /**
         * Get playoffInstanciaplayoff
         *
         * @return string
         */
        public function getPlayoffInstanciaplayoff()
        {
            return $this->playoffInstanciaplayoff;
        }



        /**
         * Set latLng
         *
         * @param string $latLng
         *
         * @return Torneos
         */
        public function setLatLng($latLng)
        {
            $this->latLng = $latLng;

            return $this;
        }

        /**
         * Get latLng
         *
         * @return string
         */
        public function getlatLng()
        {
            return $this->latLng;
        }



    public function __toString(){
      return $this->nombre;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Torneos
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Torneos
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add equipo
     *
     * @param \BackendBundle\Entity\Equipos $equipo
     *
     * @return Torneos
     */
    public function addEquipo(\BackendBundle\Entity\Equipos $equipo)
    {
        $this->equipos[] = $equipo;

        return $this;
    }

    /**
     * Remove equipo
     *
     * @param \BackendBundle\Entity\Equipos $equipo
     */
    public function removeEquipo(\BackendBundle\Entity\Equipos $equipo)
    {
        $this->equipos->removeElement($equipo);
    }

    /**
     * Get equipos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipos()
    {
        return $this->equipos;
    }
}
