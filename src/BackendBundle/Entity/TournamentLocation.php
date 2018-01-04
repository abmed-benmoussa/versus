<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Tipotorneos
 *
 * @ORM\Table(name="tournament_location")
 * @ORM\Entity
 */
class TournamentLocation
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
     * @ORM\Column(name="name", type="string", length=200)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */

    private $latitude;
    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;
    /**
     * @var string
     *
     * @ORM\Column(name="zoom", type="integer")
     */
    private $zoom;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="BackendBundle\Entity\Tournament", mappedBy="tournamentLocations", cascade={"persist"})
     */
    private $tournaments;

    /**
    * @var \Doctrine\Common\Collections\Collection
    *
    * @ORM\OneToMany(targetEntity="BackendBundle\Entity\TournamentGame", mappedBy="location", cascade={"all"})
     */
    private $tournamentGames;

    public function __toString()
    {
        return $this->name;
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
     * @return TournamentLocation
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
     * Set latitude
     *
     * @param float $latitude
     *
     * @return TournamentLocation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return TournamentLocation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set zoom
     *
     * @param integer $zoom
     *
     * @return TournamentLocation
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Get zoom
     *
     * @return integer
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return TournamentLocation
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
     * @return TournamentLocation
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
     * @return TournamentLocation
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
     * Constructor
     */
    public function __construct()
    {
        $this->tournaments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tournament
     *
     * @param \BackendBundle\Entity\Tournament $tournament
     *
     * @return TournamentLocation
     */
    public function addTournament(\BackendBundle\Entity\Tournament $tournament)
    {
        $this->tournaments[] = $tournament;

        return $this;
    }

    /**
     * Remove tournament
     *
     * @param \BackendBundle\Entity\Tournament $tournament
     */
    public function removeTournament(\BackendBundle\Entity\Tournament $tournament)
    {
        $this->tournaments->removeElement($tournament);
    }

    /**
     * Get tournaments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournaments()
    {
        return $this->tournaments;
    }

    /**
     * Add tournamentGame
     *
     * @param \BackendBundle\Entity\TournamentGame $tournamentGame
     *
     * @return TournamentLocation
     */
    public function addTournamentGame(\BackendBundle\Entity\TournamentGame $tournamentGame)
    {
        $this->tournamentGames[] = $tournamentGame;

        return $this;
    }

    /**
     * Remove tournamentGame
     *
     * @param \BackendBundle\Entity\TournamentGame $tournamentGame
     */
    public function removeTournamentGame(\BackendBundle\Entity\TournamentGame $tournamentGame)
    {
        $this->tournamentGames->removeElement($tournamentGame);
    }

    /**
     * Get tournamentGames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournamentGames()
    {
        return $this->tournamentGames;
    }
}
