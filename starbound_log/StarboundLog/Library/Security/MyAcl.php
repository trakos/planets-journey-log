<?php

namespace StarboundLog\Library\Security;


use Trks\Singletons\TrksAcl;

class MyAcl extends TrksAcl
{

    const ROLE_ADMIN = "admin";
    const ROLE_USER = "user";
    const ROLE_GUEST = "guest";

    const RES_ADMIN = "admin";
    const RES_USER = "user";
    const RES_GUEST = "guest";
    const RES_LOGGED_OFF = "loginPage";

    static protected $aclConfig;

    static public function register($aclConfig)
    {
        self::$aclConfig = $aclConfig;
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
        return parent::isRoleAllowedToRouteInConfig(self::$aclConfig, MyAuth::getRole(), $module, $controller, $action);
    }

    static public function findRouteResource($module, $controller, $action)
    {
        return parent::findRouteResourceInConfig(self::$aclConfig, $module, $controller, $action);
    }
} 