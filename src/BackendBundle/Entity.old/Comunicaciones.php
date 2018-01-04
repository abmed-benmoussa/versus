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
class Comunicaciones
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $observacion;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $imagen;

    /**
     * @Vich\UploadableField(mapping="comunicacion_images", fileNameProperty="imagen")
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
    private $enlace;


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
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Comunicaciones
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
     * Set enlace
     *
     * @param string $enlace
     *
     * @return Comunicaciones
     */
    public function setEnlace($enlace)
    {
        $this->enlace = $enlace;

        return $this;
    }

    /**
     * Get enlace
     *
     * @return string
     */
    public function getEnlace()
    {
        return $this->enlace;
    }
}
