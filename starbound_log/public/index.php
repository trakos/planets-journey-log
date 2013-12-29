<?php

use \StarboundLog\Model\Entities\StarboundVersions;

require(dirname(__DIR__) . '/init.php');

Zend\Mvc\Application::init(array(
    'listeners' => array(
        'Trks\\Events\\LayoutAndTemplateListener'
    ),
    'service_manager' => array(
        'invokables' => array(
            'Trks\\Events\\LayoutAndTemplateListener' => 'Trks\\Events\\LayoutAndTemplateListener',
        ),
    ),
    'modules' => StarboundLog::getModuleNamespaces(),
    'module_listener_options' => array(
        'module_paths' => StarboundLog::getModulePaths(),

        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' => array(
            T_PATH_CONFIG . '/zend/*.config.php',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => StarboundLog::getModulesViewPaths()
    )
))->run();
