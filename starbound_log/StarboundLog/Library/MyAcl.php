<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 31.12.13
 * Time: 02:35
 */

namespace StarboundLog\Library;


use Trks\TrksAcl;

class MyAcl extends TrksAcl
{
    /**
     * acl.config.php
     * @var array
     */
    static public $aclConfig;

    const ROLE_ADMIN = "admin";
    const ROLE_USER = "user";
    const ROLE_GUEST = "guest";

    const RES_ADMIN = "admin";
    const RES_USER = "user";
    const RES_GUEST = "guest";
    const RES_LOGGED_OFF = "loginPage";

    static public function register()
    {
        parent::register(self::$aclConfig);
    }

    /**
     * @param $module
     * @param $controller
     * @param $action
     *
     * @return bool
     */
    static public function isAllowedToRoute($module, $controller, $action)
    {
        return parent::isRoleAllowedToRoute(self::$aclConfig, MyAuth::getRole(), $module, $controller, $action);
    }

    static public function findRouteResource($module, $controller, $action)
    {
        return parent::findRouteResource(self::$aclConfig, $module, $controller, $action);
    }
} 