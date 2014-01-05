<?php

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\Mvc\MyAbstractController;
use StarboundLog\Model\Forms\Student;
use StarboundLog\Model\ViewData;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Element;

class Planets extends MyAbstractController
{
    public function allAction()
    {
        $student    = new Student();
        $formResult = $this->useAnnotationForm($student, 'main', 'all', 'planets');

        if ($formResult->isPost && !$formResult->isValid) $this->flashMessenger()->addErrorMessage('There were some errors');

        foreach ($formResult->form->getElements() as $element) {
            /* @var Element $element */
        }
        return array('form' => $formResult->form);
    }

    public function myAction()
    {

    }

    public function addAction()
    {

    }

    public function showAction()
    {

    }
} 