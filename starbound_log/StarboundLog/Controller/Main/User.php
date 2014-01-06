<?php

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Library\Mvc\MyAbstractController;
use StarboundLog\Library\Singletons\Registration;
use StarboundLog\Model\Database\Proxies\Proxy_users;
use StarboundLog\Model\Forms\Login;
use StarboundLog\Model\Forms\Register;
use StarboundLog\Model\ViewData;
use Trks\Mvc\Controller\TrksForwardException;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Element;

class User extends MyAbstractController
{
    public function registerAction()
    {
        if (MyAuth::hasIdentity()) {
            return $this->redirect()->toRoute('main');
        }
        $registerForm = new Register();
        $formResult   = $this->useAnnotationForm($registerForm, 'main', 'register', 'user');


        if ($formResult->isPost && !$formResult->isValid) {
            $this->flashMessenger()->addErrorMessage('Form validation failed.');
        } else if ($formResult->isPost && $formResult->isValid) {
            Registration::get()->register($registerForm->username, $registerForm->password, $registerForm->mail);
            $this->flashMessenger()->addSuccessMessage('Account created, you can log in now!');
            $this->flashMessenger()->addInfoMessage('An email was sent to ' . $registerForm->mail . ' with a link to confirm your address.');
            return $this->redirect()->toRoute('main', array(
                'controller' => 'user',
                'action'     => 'login',
            ));
        }

        return array('form' => $formResult->form);
    }

    public function logoutAction()
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

    public function confirmEmailAddressAction()
    {
        $userId = $this->params()->fromRoute('id');
        $hash = $this->params()->fromQuery('hash');
        $user = null;
        if (!$userId || !$hash || !Proxy_users::get()->userExists($userId)) {
            $this->flashMessenger()->addErrorMessage('Wrong url used or user does not exists.');
        } else {
            $user = Proxy_users::get()->getRow($userId);
            if ($user->user_mailConfirmed) {
                $this->flashMessenger()->addWarningMessage('Mail already confirmed!');
            } else if (Registration::get()->checkActivationHash($user, $hash)) {
                $user->user_mailConfirmed = true;
                Proxy_users::get()->saveRow($user);

                $this->flashMessenger()->addSuccessMessage('Mail confirmed, thank you!');
            } else {
                $this->flashMessenger()->addErrorMessage('Wrong url used');
            }
        }
        return $this->redirect()->toRoute('main');
    }
}