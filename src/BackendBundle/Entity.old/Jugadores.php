<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
#use Vich\UploaderBundle\Mapping\PropertyMapping as Vich;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Jugadores
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $goles;

    /**
     * @var integer
     */
    private $atajadas;

    /**
     * @var integer
     */
    private $asistencias;

    /**
     * @var boolean
     */
    private $estado;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $imagen;

    /**
     * @Vich\UploadableField(mapping="jugador_images", fileNameProperty="imagen")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \BackendBundle\Entity\Equipos
     */
    private $equipos;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $user;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Jugadores
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
     * Set goles
     *
     * @param integer $goles
     *
     * @return Jugadores
     */
    public function setGoles($goles)
    {
        $this->goles = $goles;

        return $this;
    }

    /**
     * Get goles
     *
     * @return integer
     */
    public function getGoles()
    {
        return $this->goles;
    }

    /**
     * Set atajadas
     *
     * @param integer $atajadas
     *
     * @return Jugadores
     */
    public function setAtajadas($atajadas)
    {
        $this->atajadas = $atajadas;

        return $this;
    }

    /**
     * Get atajadas
     *
     * @return integer
     */
    public function getAtajadas()
    {
        return $this->atajadas;
    }

    /**
     * Set asistencias
     *
     * @param integer $asistencias
     *
     * @return Jugadores
     */
    public function setAsistencias($asistencias)
    {
        $this->asistencias = $asistencias;

        return $this;
    }

    /**
     * Get asistencias
     *
     * @return integer
     */
    public function getAsistencias()
    {
        return $this->asistencias;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Jugadores
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Comunicaciones
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }


    public function setImageFile(File $imagen = null){
      $this->imageFile = $imagen;

      // VERY IMPORTANT:
      // It is required that at least one field changes if you are using Doctrine,
      // otherwise the event listeners won't be called and the file is lost
      if ($imagen) {
          // if 'updatedAt' is not defined in your entity, use another property
          $this->updatedAt = new \DateTime('now');
      }
    }

    public function getImageFile(){
      return $this->imageFile;
    }



    /**
     * Set equipos
     *
     * @param \BackendBundle\Entity\Equipos $equipos
     *
     * @return Jugadores
     */
    public function setEquipos(\BackendBundle\Entity\Equipos $equipos = null)
    {
        $this->equipos = $equipos;

        return $this;
    }

    /**
     * Get equipos
     *
     * @return \BackendBundle\Entity\Equipos
     */
    public function getEquipos()
    {
        return $this->equipos;
    }

    /**
     * Set user
     *
     * @param \BackendBundle\Entity\User $user
     *
     * @return User
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
}
