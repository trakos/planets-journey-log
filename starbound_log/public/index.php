<?php

chdir(dirname(__DIR__));

define('APPLICATION_PATH', dirname(__DIR__) . '/');
define('MODULES_PATH', APPLICATION_PATH . '/StarboundLog/Controller/');
define('MODULES_NAMESPACE', 'StarboundLog\\Controller');
define('ZEND2_PATH', '/var/www/phpinclude/Zend');

if (APPLICATION_PATH == "/var/www/dev/starbound_log_dev") {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set('html_errors', false);
}


require ZEND2_PATH . '/Loader/StandardAutoloader.php';
require APPLICATION_PATH . '/StarboundLog/StarboundLog.php';

(new Zend\Loader\StandardAutoloader())
    ->setOptions(array(
        'autoregister_zf' => true
    ))
    ->registerNamespace('StarboundLog', APPLICATION_PATH . '/StarboundLog')
    ->register();

Zend\Mvc\Application::init(array(

    'modules' => StarboundLog::getModuleNamespaces(),
    'module_listener_options' => array(
        'module_paths' => StarboundLog::getModulePaths(),

        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' => array(
            APPLICATION_PATH . '/config/zend/*.config.php',
        ),
    ),

))->run();
