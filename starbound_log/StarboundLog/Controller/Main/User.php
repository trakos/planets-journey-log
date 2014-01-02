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
use Zend\Form\Annotation\AnnotationBuilder;

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

        $request = $this->getRequest();
        if ($request instanceof \Zend\Http\PhpEnvironment\Request) {
            if ($request->isPost()) {
                print_r($request->getPost());die();
            }
        }
    }

    public function settingsAction()
    {

    }
}