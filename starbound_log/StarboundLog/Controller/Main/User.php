<?php

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Library\Mvc\MyAbstractController;
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
            $this->flashMessenger()->addErrorMessage('Form validation failed.');
        } else if ($formResult->isPost && $formResult->isValid) {
            Proxy_users::get()->createUser($registerForm->username, $registerForm->password, $registerForm->mail);
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
            $this->flashMessenger()->addErrorMessage('Form validation failed.');
        } else if ($formResult->isPost && $formResult->isValid) {
            $loginResult = MyAuth::authenticate($loginForm->username, $loginForm->password);
            if ($loginResult->getCode() == \Zend\Authentication\Result::SUCCESS) {
                return $this->redirect()->toRoute('main');
            }
            $this->flashMessenger()->addErrorMessage($loginResult->getMessages());
        }
        return array('form' => $formResult->form);
    }

    public function settingsAction()
    {

    }
}