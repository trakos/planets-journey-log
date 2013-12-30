<?php

namespace StarboundLog\Library;

use StarboundLog\Model\Database\Proxies\Proxy_users;
use Zend\Authentication\Result;

class MyAuthAdapter implements \Zend\Authentication\Adapter\AdapterInterface
{
    protected $username;
    protected $password;

    /**
     * Sets username and password for authentication
     *
     * @param $username
     * @param $password
     *
     * @return \StarboundLog\Library\MyAuthAdapter
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $user = Proxy_users::get()->auth($this->username, $this->password);
        if (!$user) {
            return new Result(Result::FAILURE, null, array("Username or password invalid!"));
        }
        return new Result(Result::SUCCESS, $user->user_id);
    }
}