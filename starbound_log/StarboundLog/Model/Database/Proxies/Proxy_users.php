<?php

namespace StarboundLog\Model\Database\Proxies;


use StarboundLog\Model\Database\Entities\Entity_users;
use StarboundLog\Model\Database\Rows\Row_users;
use StarboundLog\Model\Database\Tables\Table_users;

/**
 * Class Proxy_users
 *
 * @package StarboundLog\Model\Database\Proxies
 *
 * @method \StarboundLog\Model\Database\Entities\Entity_users[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Entities\Entity_users|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Entities\Entity_users[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Entities\Entity_users|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Entities\Entity_users[] getAllRows()
 * @method \StarboundLog\Model\Database\Entities\Entity_users|null getRow($primaryId)
 */
class Proxy_users extends Table_users
{
    /**
     * @var Proxy_Users
     */
    static private $instance;

    /**
     * @return Proxy_Users
     */
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Proxy_users());
    }

    /**
     * @param $primaryId
     *
     * @return bool
     */
    public function userExists($primaryId)
    {
        return $this->getRow($primaryId) != null;
    }

    /**
     * @param $username
     * @param $password
     *
     * @return Entity_users
     */
    public function auth($username, $password)
    {
        $user = $this->filterRowsGetFirst(array('user_login' => $username));
        if ($user && password_verify($password, $user->user_password)) {
            return $user;
        }
        return null;
    }

    /**
     * @param $login
     * @param $mail
     * @param $password
     *
     * @return Entity_users
     */
    public function createUser($login, $password, $mail)
    {
        $user = new Row_users();
        $user->user_login = $login;
        $user->user_password = password_hash($password, PASSWORD_DEFAULT);
        $user->user_mail = $mail;
        $user->user_mailConfirmed = false;
        $this->saveRow($user);
        return $user;
    }

    /**
     * @return Entity_users|Row_users
     */
    protected function getPrototype()
    {
        return new Entity_users();
    }
} 