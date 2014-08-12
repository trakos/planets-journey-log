<?php


return array(
    'service_manager' => array(
        'factories' => array(
            'Navigation' => 'StarboundLog\Library\Mvc\MyNavigationFactory',
        )
    ),
    'view_helpers'    => array(
        'factories' => array(
            'Navigation' => function (\Zend\View\HelperPluginManager $pm) {

                    /* @var \Zend\View\Helper\Navigation $navigation */
                    $navigation = $pm->get('Zend\View\Helper\Navigation');
                    return $navigation
                        ->setAcl(StarboundLog\Library\Security\MyAcl::getAcl())
                        ->setRole(StarboundLog\Library\Security\MyAuth::getRole())
                        ->setUseAcl();
                },
        )
    ),
    'navigation'      => array(
        'my_navigation' => array(
            array(
                'label'      => 'Home',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'home',
                'controller' => 'home',
                'action'     => 'index',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'Add planet',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'plus',
                'controller' => 'planets',
                'action'     => 'add',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'Add visit',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'rocket',
                'controller' => 'planets',
                'action'     => 'add',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'All planets',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'planet',
                'controller' => 'planets',
                'action'     => 'all',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'My planets',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'globe',
                'controller' => 'planets',
                'action'     => 'my',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'Favorite planets',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'star',
                'controller' => 'profile',
                'action'     => 'favorites',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'My characters',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'users',
                'controller' => 'profile',
                'action'     => 'characters',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'Log in',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'key-2',
                'controller' => 'user',
                'action'     => 'login',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'Log off',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'off',
                'controller' => 'user',
                'action'     => 'logout',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
            array(
                'label'      => 'Register',
                'module'     => 'main',
                'route'      => 'main',
                'icon'       => 'add-contact',
                'controller' => 'user',
                'action'     => 'register',
                'resource'   => \StarboundLog\Library\Security\MyAcl::RES_ADMIN,
            ),
        ),
    ),
);