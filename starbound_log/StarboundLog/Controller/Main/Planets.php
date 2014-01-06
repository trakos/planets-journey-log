<?php

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\Mvc\MyAbstractController;
use StarboundLog\Model\Forms\AddPlanetVisitForm;
use Zend\Form\Element;

class Planets extends MyAbstractController
{
    public function allAction()
    {
    }

    public function myAction()
    {
    }

    public function addAction()
    {
        $planetAddForm = new AddPlanetVisitForm();
        $formResult       = $this->useAnnotationForm($planetAddForm, 'main', 'add', 'planets');

        if ($formResult->isPost && !$formResult->isValid) {
            $this->flashMessenger()->addErrorMessage('Form validation failed.');
        } else if ($formResult->isPost && $formResult->isValid) {

            $this->flashMessenger()->addSuccessMessage('Form validation ok.');
        }

        return array('form' => $formResult->form);
    }

    public function showAction()
    {

    }
} 