<?php

use StarboundLog\Library\MyAcl as Acl;

return array(
    'roles'             => array(
        array(
            'name'    => Acl::ROLE_GUEST,
            'parents' => null,
            'allowed' => array(Acl::RES_LOGGED_OFF, Acl::RES_GUEST),
        ),
        array(
            'name'    => Acl::ROLE_USER,
            'parents' => Acl::ROLE_GUEST,
            'allowed' => array(Acl::RES_USER),
            'denied'  => array(Acl::RES_LOGGED_OFF),
        ),
        array(
            'name'    => Acl::ROLE_ADMIN,
            'parents' => Acl::ROLE_USER,
            'allowed' => array(Acl::RES_ADMIN),
        ),
    ),
    'route_permissions' => array(
        array(
            'module'     => 'main',
            'controller' => 'home',
            'action'     => null,
            'resource'   => Acl::RES_GUEST
        ),
        array(
            'module'     => 'main',
            'controller' => 'user',
            'action'     => 'register',
            'resource'   => Acl::RES_LOGGED_OFF
        ),
        array(
            'module'     => 'main',
            'controller' => 'user',
            'action'     => 'login',
            'resource'   => Acl::RES_LOGGED_OFF
        ),
        array(
            'module'     => 'main',
            'controller' => 'user',
            'action'     => null,
            'resource'   => Acl::RES_USER
        ),
        array(
            'module'     => 'main',
            'controller' => 'planets',
            'action'     => 'all',
            'resource'   => Acl::RES_GUEST
        ),
        array(
            'module'     => 'main',
            'controller' => 'planets',
            'action'     => null,
            'resource'   => Acl::RES_USER
        ),
    ),
);