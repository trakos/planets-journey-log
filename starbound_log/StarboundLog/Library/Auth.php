<?php

namespace StarboundLog\Library;

use StarboundLog\Model\Entities\Users;
use Zend\Authentication\AuthenticationService;

class Auth
{
    static protected $authService;

    /**
     * @return AuthenticationService
     */
    public static function getAuthService()
    {
        return self::$authService ?: (self::$authService = new AuthenticationService());
    }

    /**
     * @param $username
     * @param $password
     *
     * @return \Zend\Authentication\Result
     */
    public static function authenticate($username, $password)
    {
        $adapter = new MyAuthAdapter($username, $password);
        return self::getAuthService()->authenticate($adapter);
    }

    /**
     * @return bool
     */
    public static function hasIdentity()
    {
        return self::getAuthService()->hasIdentity();
    }

    /**
     * @return Users
     */
    public static function getIdentity()
    {
        return Users::getRepo()->find(self::getAuthService()->getIdentity());
    }


}