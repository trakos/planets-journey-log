<?php

namespace StarboundLog\Library;


use StarboundLog\Model\ViewData;
use Trks\Mvc\Controller\TrksAbstractController;
use Trks\Mvc\Controller\TrksForwardException;
use Zend\View\Model\ViewModel;

class MyAbstractController extends TrksAbstractController
{
    /**
     * @param $module
     * @param $controller
     * @param $action
     *
     * @throws \Trks\Mvc\Controller\TrksForwardException
     *
     */
    protected function isAllowed($module, $controller, $action)
    {
        if (!MyAcl::isAllowedToRoute($module, $controller, $action)) {
            if (MyAcl::getAcl()->isAllowed(MyAuth::getRole(), MyAcl::RES_LOGGED_OFF)) {
                throw new TrksForwardException('main', array('module' => 'main', 'controller' => 'user', 'action' => 'login'));
            } else {
                throw new TrksForwardException('main');
            }
        }
    }

    /**
     * Called after action dispatch.
     *
     * @param ViewModel $viewData
     */
    protected function createViewData(ViewModel $viewData)
    {
        ViewData::$identity = MyAuth::hasIdentity() ? MyAuth::getIdentity() : null;
    }

    /**
     * @throws \Exception
     * @return void|\Zend\Http\PhpEnvironment\Request
     */
    public function getRequest()
    {
        $request = parent::getRequest();
        if (!$request || $request instanceof \Zend\Http\PhpEnvironment\Request) {
            return $request;
        } else {
            throw new \Exception("Wrong request type!");
        }
    }
}