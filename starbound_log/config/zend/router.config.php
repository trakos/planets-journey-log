<?php

return array(
    'router' => array(
        'routes' => array(
            'regular'    => array(
                'type'    => 'Trks\\Mvc\\Router\\TrksRouter',
                'options' => array(
                    'route'       => '/[:module][/:controller[/:action]][/:id]',
                    'constraints' => array(
                        'module'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]*',
                    ),
                    'defaults'    => array(
                        'module'     => StarboundLog::getDefaultModule(),
                        'controller' => 'home',
                        'action'     => 'index',
                    ),
                ),
            ),
            'main'       => array(
                'type'    => 'Trks\\Mvc\\Router\\TrksRouter',
                'options' => array(
                    'route'       => '/[:controller[/:action]][/:id]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]*',
                    ),
                    'defaults'    => array(
                        'module'     => StarboundLog::getDefaultModule(),
                        'controller' => 'home',
                        'action'     => 'index',
                    ),
                ),
            ),
            'main-index' => array(
                'type'    => 'Trks\\Mvc\\Router\\TrksRouter',
                'options' => array(
                    'route'       => '/[:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]*',
                    ),
                    'defaults'    => array(
                        'module'     => StarboundLog::getDefaultModule(),
                        'controller' => 'home',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
);