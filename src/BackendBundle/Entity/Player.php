<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Equipos
 *
 * @ORM\Entity
 * @ORM\Table(name="player")
 */
class Player
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
     * @ORM\Column(name="shirt_number", type="integer", nullable=true)
     */
    private $shirtNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="color", type="boolean", nullable=false)
     */
    private $isCaptain;

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
     * @ORM\OneToOne(targetEntity="User", inversedBy="player", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \BackendBundle\Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Team", inversedBy="players")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * })
     */
    private $team;

    public function __toString()
    {
        return sprintf('%s %s',$this->user->getFirstName(), $this->user->getLastName());
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
     * Set shirtNumber
     *
     * @param integer $shirtNumber
     *
     * @return Player
     */
    public function setShirtNumber($shirtNumber)
    {
        $this->shirtNumber = $shirtNumber;

        return $this;
    }

    /**
     * Get shirtNumber
     *
     * @return integer
     */
    public function getShirtNumber()
    {
        return $this->shirtNumber;
    }

    /**
     * Set isCaptain
     *
     * @param boolean $isCaptain
     *
     * @return Player
     */
    public function setIsCaptain($isCaptain)
    {
        $this->isCaptain = $isCaptain;

        return $this;
    }

    /**
     * Get isCaptain
     *
     * @return boolean
     */
    public function getIsCaptain()
    {
        return $this->isCaptain;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * Set user
     *
     * @param \BackendBundle\Entity\User $user
     *
     * @return Player
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
     * Set team
     *
     * @param \BackendBundle\Entity\Team $team
     *
     * @return Player
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
}
