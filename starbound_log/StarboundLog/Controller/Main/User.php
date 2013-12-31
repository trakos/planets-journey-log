<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 30.12.13
 * Time: 21:03
 */

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\Auth;
use StarboundLog\Library\MyAbstractController;

class User extends MyAbstractController
{
    public function registerAction()
    {

    }

    public function queueAction()
    {

    }

    public function logoffAction()
    {

    }

    public function loginAction()
    {
        if (Auth::hasIdentity()) {
            throw new \Exception("!");
        }

    }

    public function settingsAction()
    {

    }
}