<?php

namespace StarboundLog\Library\Mvc;


use StarboundLog\Library\Security\MyAcl;
use Trks\Navigation\TrksNavigationFactory;
use Zend\Mvc\Router\Http\RouteInterface;
use Zend\Mvc\Router\RouteMatch;
use Zend\Permissions\Acl\Resource\GenericResource;

class MyNavigationFactory extends TrksNavigationFactory
{

    /**
     * @return string
     */
    protected function getName()
    {
        return 'my_navigation';
    }

    /**
     * @param $module
     * @param $controller
     * @param $action
     *
     * @return string|GenericResource
     */
    function getResourceForRoute($module, $controller, $action)
    {

        if (!$module || !$controller || !$action) {
            return MyAcl::RES_ADMIN;
        }
        return MyAcl::findRouteResource($module, $controller, $action) ? : MyAcl::RES_ADMIN;
    }
}