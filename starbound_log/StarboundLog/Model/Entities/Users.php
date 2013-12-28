<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="StarboundLog\Model\Repositories\UsersRepository")
 */
class Users extends \StarboundLog\Library\AbstractEntity
{
    /**
     * @return \StarboundLog\Model\Repositories\UsersRepository
     */
    static public function getRepo()
    {
        return \StarboundLog::getEntityManager()->getRepository('StarboundLog\Model\Entities\Users');
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_login", type="string", length=64, nullable=false)
     */
    private $userLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=256, nullable=false)
     */
    private $userPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="user_mail", type="string", length=256, nullable=false)
     */
    private $userMail;



    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userLogin
     *
     * @param string $userLogin
     * @return Users
     */
    public function setUserLogin($userLogin)
    {
        $this->userLogin = $userLogin;
    
        return $this;
    }

    /**
     * Get userLogin
     *
     * @return string 
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     * @return Users
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
    
        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string 
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userMail
     *
     * @param string $userMail
     * @return Users
     */
    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;
    
        return $this;
    }

    /**
     * Get userMail
     *
     * @return string 
     */
    public function getUserMail()
    {
        return $this->userMail;
    }
}