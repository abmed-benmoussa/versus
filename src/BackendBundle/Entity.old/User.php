<?php
namespace BackendBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity(repositoryClass="danvbe\UserBundle\Repository\UserRepository")
 * @ORM\Table(name="lcl_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $facebook_id;

    protected $facebook_access_token;

    protected $google_id;

    protected $google_access_token;

    public function getId() {
        return $this->id;
    }

    public function setId() {
        $this->id = $id;
    }

    //YOU CAN ADD MORE CODE HERE !
    public function getFacebookId() {
        return $this->facebook_id;
    }

    public function setFacebookId($facebook_id) {
        $this->facebook_id = $facebook_id;
    }

    public function getFacebookAccessToken() {
        return $this->facebook_access_token;
    }

    public function setFacebookAccessToken($facebook_access_token) {
        $this->facebook_access_token = $facebook_access_token;
    }

    public function getGoogleId() {
        return $this->google_id;
    }

    public function setGoogleId($google_id) {
        $this->google_id = $google_id;
    }

    public function getGoogleAccessToken() {
        return $this->google_access_token;
    }

    public function setGoogleAccessToken($google_access_token) {
        $this->google_access_token = $google_access_token;
    }

}
