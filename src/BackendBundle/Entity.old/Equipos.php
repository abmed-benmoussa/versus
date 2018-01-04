<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Form\Type\VichFileType;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Equipos
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
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $logo;

    /**
     * @Vich\UploadableField(mapping="equipo_images", fileNameProperty="logo")
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
    private $grupo;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var \BackendBundle\Entity\Torneos[]
     */
    private $torneos;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Equipos
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
     * @return Equipos
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Equipos
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
      return file_exists($this->imageFile) ? new File($this->imageFile) : $this->imageFile;
    }


    /**
     * Set grupo
     *
     * @param string $grupo
     *
     * @return Equipos
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Equipos
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    public function __toString(){
      return $this->nombre;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

   /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Documentos
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->torneos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add torneo
     *
     * @param \BackendBundle\Entity\Torneos $torneo
     *
     * @return Equipos
     */
    public function addTorneo(\BackendBundle\Entity\Torneos $torneo)
    {
        $this->torneos[] = $torneo;

        return $this;
    }

    /**
     * Remove torneo
     *
     * @param \BackendBundle\Entity\Torneos $torneo
     */
    public function removeTorneo(\BackendBundle\Entity\Torneos $torneo)
    {
        $this->torneos->removeElement($torneo);
    }

    /**
     * Get torneos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTorneos()
    {
        return $this->torneos;
    }
}
