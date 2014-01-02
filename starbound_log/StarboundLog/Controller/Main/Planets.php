<?php

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\MyAbstractController;
use StarboundLog\Model\Forms\Student;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Element;

class Planets extends MyAbstractController
{
    public function allAction()
    {
        $student    = new Student();
        $builder    = new AnnotationBuilder();
        $form       = $builder->createForm($student);

        $request = $this->getRequest();
        if ($request->isPost()){
            $form->bind($student);
            $form->setData($request->getPost());
            if ($form->isValid()){
                print_r($form->getData());
            }
        }

        $form->setAttribute('action', $this->url()->fromRoute('main', array(
            'controller' => 'planets',
            'action' => 'all',
        )));
        $form->prepare();
        foreach ($form->getElements() as $element) {
            /* @var Element $element */
        }
        return array('form'=>$form);
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