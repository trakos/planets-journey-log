<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_users
 * 
 * 
 * name="users"
 */
class Row_users
{
    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var string
     */
    public $user_login;

    /**
     * @var string
     */
    public $user_password;

    /**
     * @var string
     */
    public $user_mail;


    public function exchangeArray($data)
    {
        $this->user_id = (isset($data['user_id'])) ? $data['user_id'] : null;
        $this->user_login = (isset($data['user_login'])) ? $data['user_login'] : null;
        $this->user_password = (isset($data['user_password'])) ? $data['user_password'] : null;
        $this->user_mail = (isset($data['user_mail'])) ? $data['user_mail'] : null;
    }
}
