<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Torneos
 *
 * @ORM\Table(name="tournament_team")
 * @ORM\Entity(repositoryClass="\BackendBundle\Repository\TournamentTeamRepository")
 */
class TournamentTeam
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
     * @ORM\Column(name="group_name", type="string", length=1, nullable=true)
     */
    private $group;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

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
     * @var \BackendBundle\Entity\Tournament
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Tournament", inversedBy="tournamentTeams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     * })
     */
    private $tournament;

    /**
     * @var \BackendBundle\Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Team", inversedBy="tournamentTeams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * })
     */
    private $team;

    /**
    * @var \Doctrine\Common\Collections\Collection
    *
    * @ORM\OneToMany(targetEntity="BackendBundle\Entity\TournamentGame", mappedBy="homeTeam", cascade={"all"})
     */
    private $homeGames;

    /**
    * @var \Doctrine\Common\Collections\Collection
    *
    * @ORM\OneToMany(targetEntity="BackendBundle\Entity\TournamentGame", mappedBy="visitTeam", cascade={"all"})
     */
    private $visitGames;

    public function __toString()
    {
        return sprintf(
            "%s - %s",
            $this->getTournament(),
            $this->getTeam()
        );
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
     * Set group
     *
     * @param string $group
     *
     * @return TournamentTeam
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return TournamentTeam
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return TournamentTeam
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
     * @return TournamentTeam
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
     * @return TournamentTeam
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
     * Set tournament
     *
     * @param \BackendBundle\Entity\Tournament $tournament
     *
     * @return TournamentTeam
     */
    public function setTournament(\BackendBundle\Entity\Tournament $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \BackendBundle\Entity\Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set team
     *
     * @param \BackendBundle\Entity\Team $team
     *
     * @return TournamentTeam
     */
    public function setTeam(\BackendBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \BackendBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->homeGames = new \Doctrine\Common\Collections\ArrayCollection();
        $this->visitGames = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add homeGame
     *
     * @param \BackendBundle\Entity\TournamentGame $homeGame
     *
     * @return TournamentTeam
     */
    public function addHomeGame(\BackendBundle\Entity\TournamentGame $homeGame)
    {
        $this->homeGames[] = $homeGame;

        return $this;
    }

    /**
     * Remove homeGame
     *
     * @param \BackendBundle\Entity\TournamentGame $homeGame
     */
    public function removeHomeGame(\BackendBundle\Entity\TournamentGame $homeGame)
    {
        $this->homeGames->removeElement($homeGame);
    }

    /**
     * Get homeGames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomeGames()
    {
        return $this->homeGames;
    }

    /**
     * Add visitGame
     *
     * @param \BackendBundle\Entity\TournamentGame $visitGame
     *
     * @return TournamentTeam
     */
    public function addVisitGame(\BackendBundle\Entity\TournamentGame $visitGame)
    {
        $this->visitGames[] = $visitGame;

        return $this;
    }

    /**
     * Remove visitGame
     *
     * @param \BackendBundle\Entity\TournamentGame $visitGame
     */
    public function removeVisitGame(\BackendBundle\Entity\TournamentGame $visitGame)
    {
        $this->visitGames->removeElement($visitGame);
    }

    /**
     * Get visitGames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisitGames()
    {
        return $this->visitGames;
    }
}
