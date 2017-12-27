<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Torneos
 *
 * @ORM\Table(name="tournament")
 * @ORM\Entity(repositoryClass="\BackendBundle\Repository\TournamentRepository")
 */
class Tournament
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=true)
     */
    private $fechaFinal;

    /**
     * @var integer
     *
     * @ORM\Column(name="partidos_dia", type="integer", nullable=true)
     */
    private $partidosDia;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_equipos", type="integer", nullable=true)
     */
    private $numeroEquipos;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=300, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="teams_per_groups", type="integer", nullable=true)
     */
    private $teamsPerGroups;

    /**
     * @var integer
     *
     * @ORM\Column(name="qualified_teams", type="integer", nullable=true)
     */
    private $qualifiedTeams;

    /**
     * @var integer
     *
     * @ORM\Column(name="group_match_modality", type="integer", nullable=true)
     */
    private $groupMatchModality;

    /**
     * @var integer
     *
     * @ORM\Column(name="playoff_match_modality", type="integer", nullable=true)
     */
    private $playoffMatchModality;

    /**
     * @var integer
     *
     * @ORM\Column(name="playoff_instance", type="integer", nullable=true)
     */
    private $playoffInstance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     * @Gedmo\Timestampable(on="update")
     */
    private $updateAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="step", type="integer", nullable=false)
     */
    private $step = 1;

    /**
     * @var \BackendBundle\Entity\TournamentType
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\TournamentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tournament_type_id", referencedColumnName="id")
     * })
     */
    private $tournamentType;

    /**
     * @var \BackendBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\TournamentTeam", mappedBy="tournament", cascade={"all"})
      */
    private $tournamentTeams;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="BackendBundle\Entity\TournamentLocation", inversedBy="tournaments", cascade={"all"})
     * @ORM\JoinTable(name="tournament_tournament_location",
     *   joinColumns={
     *     @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tournament_location_id", referencedColumnName="id")
     *   }
     * )
     */
    private $tournamentLocations;

    public function __toString()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tournamentTeams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tournamentLocations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Tournament
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Tournament
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
     * @return Tournament
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
     * Set partidosDia
     *
     * @param integer $partidosDia
     *
     * @return Tournament
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
     * Set numeroEquipos
     *
     * @param integer $numeroEquipos
     *
     * @return Tournament
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
     * Set image
     *
     * @param string $image
     *
     * @return Tournament
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tournament
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
     * Set teamsPerGroups
     *
     * @param integer $teamsPerGroups
     *
     * @return Tournament
     */
    public function setTeamsPerGroups($teamsPerGroups)
    {
        $this->teamsPerGroups = $teamsPerGroups;

        return $this;
    }

    /**
     * Get teamsPerGroups
     *
     * @return integer
     */
    public function getTeamsPerGroups()
    {
        return $this->teamsPerGroups;
    }

    /**
     * Set qualifiedTeams
     *
     * @param integer $qualifiedTeams
     *
     * @return Tournament
     */
    public function setQualifiedTeams($qualifiedTeams)
    {
        $this->qualifiedTeams = $qualifiedTeams;

        return $this;
    }

    /**
     * Get qualifiedTeams
     *
     * @return integer
     */
    public function getQualifiedTeams()
    {
        return $this->qualifiedTeams;
    }

    /**
     * Set groupMatchModality
     *
     * @param integer $groupMatchModality
     *
     * @return Tournament
     */
    public function setGroupMatchModality($groupMatchModality)
    {
        $this->groupMatchModality = $groupMatchModality;

        return $this;
    }

    /**
     * Get groupMatchModality
     *
     * @return integer
     */
    public function getGroupMatchModality()
    {
        return $this->groupMatchModality;
    }

    /**
     * Set playoffMatchModality
     *
     * @param integer $playoffMatchModality
     *
     * @return Tournament
     */
    public function setPlayoffMatchModality($playoffMatchModality)
    {
        $this->playoffMatchModality = $playoffMatchModality;

        return $this;
    }

    /**
     * Get playoffMatchModality
     *
     * @return integer
     */
    public function getPlayoffMatchModality()
    {
        return $this->playoffMatchModality;
    }

    /**
     * Set playoffInstance
     *
     * @param integer $playoffInstance
     *
     * @return Tournament
     */
    public function setPlayoffInstance($playoffInstance)
    {
        $this->playoffInstance = $playoffInstance;

        return $this;
    }

    /**
     * Get playoffInstance
     *
     * @return integer
     */
    public function getPlayoffInstance()
    {
        return $this->playoffInstance;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Tournament
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Tournament
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Tournament
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set step
     *
     * @param integer $step
     *
     * @return Tournament
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return integer
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set tournamentType
     *
     * @param \BackendBundle\Entity\TournamentType $tournamentType
     *
     * @return Tournament
     */
    public function setTournamentType(\BackendBundle\Entity\TournamentType $tournamentType = null)
    {
        $this->tournamentType = $tournamentType;

        return $this;
    }

    /**
     * Get tournamentType
     *
     * @return \BackendBundle\Entity\TournamentType
     */
    public function getTournamentType()
    {
        return $this->tournamentType;
    }

    /**
     * Set user
     *
     * @param \BackendBundle\Entity\User $user
     *
     * @return Tournament
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
     * Add tournamentTeam
     *
     * @param \BackendBundle\Entity\TournamentTeam $tournamentTeam
     *
     * @return Tournament
     */
    public function addTournamentTeam(\BackendBundle\Entity\TournamentTeam $tournamentTeam)
    {
        $this->tournamentTeams[] = $tournamentTeam;
        $tournamentTeam->setTournament($this);
        return $this;
    }

    /**
     * Remove tournamentTeam
     *
     * @param \BackendBundle\Entity\TournamentTeam $tournamentTeam
     */
    public function removeTournamentTeam(\BackendBundle\Entity\TournamentTeam $tournamentTeam)
    {
        $this->tournamentTeams->removeElement($tournamentTeam);
    }

    /**
     * Get tournamentTeams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournamentTeams()
    {
        return $this->tournamentTeams;
    }

    /**
     * Add tournamentLocation
     *
     * @param \BackendBundle\Entity\TournamentLocation $tournamentLocation
     *
     * @return Tournament
     */
    public function addTournamentLocation(\BackendBundle\Entity\TournamentLocation $tournamentLocation)
    {
        $this->tournamentLocations[] = $tournamentLocation;

        return $this;
    }

    /**
     * Remove tournamentLocation
     *
     * @param \BackendBundle\Entity\TournamentLocation $tournamentLocation
     */
    public function removeTournamentLocation(\BackendBundle\Entity\TournamentLocation $tournamentLocation)
    {
        $this->tournamentLocations->removeElement($tournamentLocation);
    }

    /**
     * Get tournamentLocations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournamentLocations()
    {
        return $this->tournamentLocations;
    }
}
