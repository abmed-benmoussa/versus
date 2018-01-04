<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Torneos
 *
 * @ORM\Table(name="tournament_game")
 * @ORM\Entity(repositoryClass="\BackendBundle\Repository\TournamentGameRepository")
 */
class TournamentGame
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
     * @var integer
     *
     * @ORM\Column(name="round", type="integer")
     */
    private $round;

    /**
     * @var integer
     *
     * @ORM\Column(name="round_type", type="integer")
     */
    private $roundType;

    /**
     * @var integer
     *
     * @ORM\Column(name="match_time", type="integer")
     */
    private $matchTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="play_at", type="datetime", nullable=true)
     */
    private $playyAt;

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
     * @var \BackendBundle\Entity\TournamentTeam
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\TournamentTeam", inversedBy="homeGames")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tournament_team_home_id", referencedColumnName="id")
     * })
     */
    private $homeTeam;

    /**
     * @var \BackendBundle\Entity\TournamentTeam
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\TournamentTeam", inversedBy="visitGames")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tournament_team_visit_id", referencedColumnName="id")
     * })
     */
    private $visitTeam;

    /**
     * @var \BackendBundle\Entity\TournamentLocation
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\TournamentLocation", inversedBy="visitGames")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tournament_location_id", referencedColumnName="id")
     * })
     */
    private $location;

    public function __toString()
    {
        return sprintf(
            "%s vs %s",
            $this->homeTeam,
            $this->visitTeam
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
     * Set matchTime
     *
     * @param integer $matchTime
     *
     * @return TournamentGame
     */
    public function setMatchTime($matchTime)
    {
        $this->matchTime = $matchTime;

        return $this;
    }

    /**
     * Get matchTime
     *
     * @return integer
     */
    public function getMatchTime()
    {
        return $this->matchTime;
    }

    /**
     * Set playyAt
     *
     * @param \DateTime $playyAt
     *
     * @return TournamentGame
     */
    public function setPlayyAt($playyAt)
    {
        $this->playyAt = $playyAt;

        return $this;
    }

    /**
     * Get playyAt
     *
     * @return \DateTime
     */
    public function getPlayyAt()
    {
        return $this->playyAt;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return TournamentGame
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
     * @return TournamentGame
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
     * @return TournamentGame
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
     * Set homeTeam
     *
     * @param \BackendBundle\Entity\TournamentTeam $homeTeam
     *
     * @return TournamentGame
     */
    public function setHomeTeam(\BackendBundle\Entity\TournamentTeam $homeTeam = null)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * Get homeTeam
     *
     * @return \BackendBundle\Entity\TournamentTeam
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * Set visitTeam
     *
     * @param \BackendBundle\Entity\TournamentTeam $visitTeam
     *
     * @return TournamentGame
     */
    public function setVisitTeam(\BackendBundle\Entity\TournamentTeam $visitTeam = null)
    {
        $this->visitTeam = $visitTeam;

        return $this;
    }

    /**
     * Get visitTeam
     *
     * @return \BackendBundle\Entity\TournamentTeam
     */
    public function getVisitTeam()
    {
        return $this->visitTeam;
    }

    /**
     * Set location
     *
     * @param \BackendBundle\Entity\TournamentLocation $location
     *
     * @return TournamentGame
     */
    public function setLocation(\BackendBundle\Entity\TournamentLocation $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \BackendBundle\Entity\TournamentLocation
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set round
     *
     * @param integer $round
     *
     * @return TournamentGame
     */
    public function setRound($round)
    {
        $this->round = $round;

        return $this;
    }

    /**
     * Get round
     *
     * @return integer
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Set roundType
     *
     * @param integer $roundType
     *
     * @return TournamentGame
     */
    public function setRoundType($roundType)
    {
        $this->roundType = $roundType;

        return $this;
    }

    /**
     * Get roundType
     *
     * @return integer
     */
    public function getRoundType()
    {
        return $this->roundType;
    }
}
