<?php

namespace StarboundLog\Library;

use StarboundLog\Model\Database\Proxies\Proxy_users;
use Zend\Authentication\AuthenticationService;

class Auth
{
    static protected $authService;

    /**
     * @return AuthenticationService
     */
    protected static function getAuthService()
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
     * @return \StarboundLog\Model\Database\Rows\Row_users
     */
    public static function getIdentity()
    {
        return Proxy_users::get()->getRow(self::getAuthService()->getIdentity());
    }


}