<?php

namespace BackendBundle\Entity;

/**
 * Amonestaciones
 */
class Amonestaciones
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
    private $observacion;

    /**
     * @var \BackendBundle\Entity\Jugadores
     */
    private $jugadores;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Amonestaciones
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
     * @return Amonestaciones
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
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Amonestaciones
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
     * Set jugadores
     *
     * @param \BackendBundle\Entity\Jugadores $jugadores
     *
     * @return Amonestaciones
     */
    public function setJugadores(\BackendBundle\Entity\Jugadores $jugadores = null)
    {
        $this->jugadores = $jugadores;

        return $this;
    }

    /**
     * Get jugadores
     *
     * @return \BackendBundle\Entity\Jugadores
     */
    public function getJugadores()
    {
        return $this->jugadores;
    }
}

