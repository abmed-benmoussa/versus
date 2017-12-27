<?php

namespace BackendBundle\Entity;

/**
 * Canchas
 */
class Canchas
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
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $lugar;

    /**
     * @var string
     */
    private $observacion;

    /**
     * @var \BackendBundle\Entity\Torneos
     */
    private $torneos;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Canchas
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
     * @return Canchas
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Canchas
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
     * Set lugar
     *
     * @param string $lugar
     *
     * @return Canchas
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Canchas
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set torneos
     *
     * @param \BackendBundle\Entity\Torneos $torneos
     *
     * @return Canchas
     */
    public function setTorneos(\BackendBundle\Entity\Torneos $torneos = null)
    {
        $this->torneos = $torneos;

        return $this;
    }

    /**
     * Get torneos
     *
     * @return \BackendBundle\Entity\Torneos
     */
    public function getTorneos()
    {
        return $this->torneos;
    }
}

