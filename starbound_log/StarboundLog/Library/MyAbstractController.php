<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 29.12.13
 * Time: 03:02
 */

namespace StarboundLog\Library;


use StarboundLog\Model\ViewData;
use StarboundLog\Model\ViewData\Menu\Item;
use Trks\TrksAbstractController;
use Trks\TrksForwardException;
use Zend\View\Model\ViewModel;

class MyAbstractController extends TrksAbstractController
{
    /**
     * @param $module
     * @param $controller
     * @param $action
     *
     * @throws \Trks\TrksForwardException
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

    protected function createViewData(ViewModel $viewData)
    {
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