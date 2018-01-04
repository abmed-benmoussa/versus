<?php

namespace BackendBundle\Entity;

/**
 * Arbitros
 */
class Arbitros
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
    private $apellido;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var \BackendBundle\Entity\Partidos
     */
    private $partidos;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Arbitros
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
     * @return Arbitros
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Arbitros
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Arbitros
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set partidos
     *
     * @param \BackendBundle\Entity\Partidos $partidos
     *
     * @return Arbitros
     */
    public function setPartidos(\BackendBundle\Entity\Partidos $partidos = null)
    {
        $this->partidos = $partidos;

        return $this;
    }

    /**
     * Get partidos
     *
     * @return \BackendBundle\Entity\Partidos
     */
    public function getPartidos()
    {
        return $this->partidos;
    }
}

