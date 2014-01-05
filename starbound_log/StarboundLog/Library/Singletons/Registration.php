<?php

namespace StarboundLog\Library\Singletons;


use StarboundLog\Library\Mail\MailRenderer;
use StarboundLog\Library\Mail\MailTransport;
use StarboundLog\Model\Database\Proxies\Proxy_users;
use StarboundLog\Model\Database\Rows\Row_users;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use ZendService\ReCaptcha\Exception;

class Registration
{
    static private $_instance;

    static public function get()
    {
        return self::$_instance ? : (self::$_instance = new Registration());
    }

    public function register($username, $password, $emailAddress)
    {
        $user = Proxy_users::get()->createUser($username, $password, $emailAddress);
        MailTransport::send($emailAddress, 'Your Planetarium registration', MailRenderer::render('registration', array(
            'username'    => $user->user_login,
            'email'       => $user->user_mail,
            'routeParams' => array(
                'controller' => 'user',
                'action'     => 'confirm-email-address',
                'id'         => $user->user_id,
            ),
            'queryParams' => array(
                'hash' => $this->getActivationHash($user)
            )
        )));
    }

    /**
     * @param Row_users $user
     * @param           $hash
     *
     * @return bool
     */
    public function checkActivationHash(Row_users $user, $hash)
    {
        $hash = base64_decode($hash);
        return password_verify($this->getRawActivationHashSourceString($user), $hash);
    }

    /**
     * @param Row_users $user
     *
     * @throws \Exception
     * @return string
     */
    public function getActivationHash(Row_users $user)
    {
        $hashed = password_hash($this->getRawActivationHashSourceString($user), PASSWORD_BCRYPT);
        if (!$hashed) {
            throw new \Exception('password_hash returned false');
        }
        return base64_encode($hashed);
    }

    /**
     * @param Row_users $user
     *
     * @throws \Exception
     * @return string
     */
    protected function getRawActivationHashSourceString(Row_users $user)
    {
        return
            '7601b15a-fd46-4140-bc10-bf0bbf629e61' . $user->user_id .
            'bb3348bb-a14a-408a-88c6-81ea4bdb0e85' . $user->user_login .
            'ce090fc8-f2bc-4f3e-9693-ed6db9ed5ade' . $user->user_mail;
    }

}