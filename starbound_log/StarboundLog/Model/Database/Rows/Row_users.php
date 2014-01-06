<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_users
 * 
 * 
 * name="users"
 */
class Row_users extends \Trks\Model\TrksAbstractRow
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

    /**
     * @var boolean
     */
    public $user_mailConfirmed;

    /**
     * @var \DateTime
     */
    public $user_lastMail;


    public function exchangeArray($data)
    {
        $this->user_id = (isset($data['user_id'])) ? $data['user_id'] : null;
        $this->user_login = (isset($data['user_login'])) ? $data['user_login'] : null;
        $this->user_password = (isset($data['user_password'])) ? $data['user_password'] : null;
        $this->user_mail = (isset($data['user_mail'])) ? $data['user_mail'] : null;
        $this->user_mailConfirmed = (isset($data['user_mailConfirmed'])) ? $data['user_mailConfirmed'] : null;
        $this->user_lastMail = (isset($data['user_lastMail'])) ? $data['user_lastMail'] : null;
    }

    public function toArray()
    {
        return array(
            'user_id' => $this->user_id,
            'user_login' => $this->user_login,
            'user_password' => $this->user_password,
            'user_mail' => $this->user_mail,
            'user_mailConfirmed' => $this->user_mailConfirmed,
            'user_lastMail' => $this->user_lastMail,
        );
    }
}
