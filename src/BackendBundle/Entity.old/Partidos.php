<?php

namespace BackendBundle\Entity;

/**
 * Partidos
 */
class Partidos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $estado;

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
     * @return Partidos
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
     * Set estado
     *
     * @param string $estado
     *
     * @return Partidos
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
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Partidos
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
     * @return Partidos
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

