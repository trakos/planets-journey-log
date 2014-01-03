<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 30.12.13
 * Time: 21:03
 */

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\MyAuth;
use StarboundLog\Library\MyAbstractController;
use StarboundLog\Model\Forms\Login;
use StarboundLog\Model\ViewData;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Element;

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
        if (MyAuth::hasIdentity()) {
            throw new \Exception("!");
        }
        $loginForm  = new Login();
        $formResult = $this->useAnnotationForm($loginForm, 'main', 'login', 'user');


        if ($formResult->isPost && !$formResult->isValid) {
            ViewData::getMessages()->errorMain = 'Form validation failed.';
        } else if ($formResult->isPost && $formResult->isValid) {
            ViewData::getMessages()->errorMain = 'The username or password you have entered is incorrect.';
        }
        return array('form' => $formResult->form);
    }

    public function settingsAction()
    {

    }
}