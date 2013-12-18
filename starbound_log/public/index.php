<?php

require(dirname(__DIR__) . '/autoload_init.php');

if (T_PATH_APPLICATION == "/var/www/dev/starbound_log_dev") {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set('html_errors', false);
}

Zend\Mvc\Application::init(array(

    'modules' => StarboundLog::getModuleNamespaces(),
    'module_listener_options' => array(
        'module_paths' => StarboundLog::getModulePaths(),

        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' => array(
            T_PATH_APPLICATION . '/config/zend/*.config.php',
        ),
    ),

))->run();
