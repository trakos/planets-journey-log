<?php

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\MyAuth;
use StarboundLog\Library\MyAbstractController;
use StarboundLog\Model\Database\Proxies\Proxy_users;
use StarboundLog\Model\Forms\Login;
use StarboundLog\Model\Forms\Register;
use StarboundLog\Model\ViewData;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Element;

class User extends MyAbstractController
{
    public function registerAction()
    {
        if (MyAuth::hasIdentity()) {
            return $this->redirect()->toRoute('main');
        }
        $registerForm  = new Register();
        $formResult = $this->useAnnotationForm($registerForm, 'main', 'register', 'user');


        if ($formResult->isPost && !$formResult->isValid) {
            ViewData::getMessages()->errorMain = 'Form validation failed.';
        } else if ($formResult->isPost && $formResult->isValid) {
            //Proxy_users::get()->register($registerForm->username, $registerForm->password, $registerForm->mail);
        }
        return array('form' => $formResult->form);
    }

    public function queueAction()
    {

    }

    public function logoffAction()
    {
        if (MyAuth::hasIdentity()) {
            MyAuth::clearIdentity();
        }
        return $this->redirect()->toRoute('main');
    }

    public function loginAction()
    {
        if (MyAuth::hasIdentity()) {
            return $this->redirect()->toRoute('main');
        }
        $loginForm  = new Login();
        $formResult = $this->useAnnotationForm($loginForm, 'main', 'login', 'user');


        if ($formResult->isPost && !$formResult->isValid) {
            ViewData::getMessages()->errorMain = 'Form validation failed.';
        } else if ($formResult->isPost && $formResult->isValid) {
            $loginResult = MyAuth::authenticate($loginForm->username, $loginForm->password);
            if ($loginResult->getCode() == \Zend\Authentication\Result::SUCCESS) {
                return $this->redirect()->toRoute('main');
            }
            if (count($loginResult->getMessages()) == 1) {
                ViewData::getMessages()->errorMain = $loginResult->getMessages()[0];
            } else {
                ViewData::getMessages()->errorList = $loginResult->getMessages();
            }
        }
        return array('form' => $formResult->form);
    }

    public function settingsAction()
    {

    }
}