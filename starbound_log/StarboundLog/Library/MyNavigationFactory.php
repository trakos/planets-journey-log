<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 31.12.13
 * Time: 06:55
 */

namespace StarboundLog\Library;


use Trks\TrksNavigationFactory;
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
        return MyAcl::findRouteResource($module, $controller, $action);
    }
}