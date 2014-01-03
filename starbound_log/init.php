<?php

chdir(__DIR__);

define('T_PATH_APPLICATION', __DIR__);
define('T_PATH_LIB', '/var/www/phpinclude');

define('T_PATH_ZEND2', T_PATH_LIB . '/Zend');
define('T_PATH_CONFIG', T_PATH_APPLICATION . '/config');
define('T_PATH_CUSTOM_CONFIG', T_PATH_CONFIG . '/custom');

define('T_PATH_SYMFONY', T_PATH_LIB . '/Symfony');
define('T_PATH_DOCTRINE', T_PATH_LIB . '/Doctrine');
define('T_PATH_TRKS', T_PATH_LIB . '/Trks');
define('T_PATH_APP_SRC', T_PATH_APPLICATION . '/StarboundLog');
define('T_PATH_MODULES', T_PATH_APPLICATION . '/StarboundLog/Controller/');

define('T_NAMESPACE_DOCTRINE', 'Doctrine');
define('T_NAMESPACE_SYMFONY', 'Symfony');
define('T_NAMESPACE_TRKS', 'Trks');
define('T_NAMESPACE_APP_SRC', 'StarboundLog');
define('T_NAMESPACE_MODULES', 'StarboundLog\\Controller');

define('T_PATH_ENTITIES', T_PATH_APP_SRC . '/Model/Entities');

/** @noinspection PhpIncludeInspection */
require T_PATH_ZEND2 . '/Loader/StandardAutoloader.php';
require T_PATH_APPLICATION . '/StarboundLog/StarboundLog.php';

// autoloader
(new Zend\Loader\StandardAutoloader())
    ->setOptions(array(
        'autoregister_zf' => true
    ))
    ->registerNamespace(T_NAMESPACE_SYMFONY, T_PATH_SYMFONY)
    ->registerNamespace(T_NAMESPACE_DOCTRINE, T_PATH_DOCTRINE)
    ->registerNamespace(T_NAMESPACE_TRKS, T_PATH_TRKS)
    ->registerNamespace(T_NAMESPACE_APP_SRC, T_PATH_APP_SRC)
    ->register();

// custom configs
StarboundLog::$structureConfig = require T_PATH_CUSTOM_CONFIG . '/structure.config.php';
StarboundLog::$viewHelperPartialsConfig = require T_PATH_CUSTOM_CONFIG . '/view_helper_partials.config.php';
StarboundLog\Library\MyAcl::$aclConfig = require T_PATH_CUSTOM_CONFIG . '/acl.config.php';


// debug
define('T_DEBUG', T_PATH_APPLICATION == "/var/www/dev/starbound_log_dev");
if (T_DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set('html_errors', false);
}

// create zend app
StarboundLog::setApplication(Zend\Mvc\Application::init(array(
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
)));

// load form data
StarboundLog::init();
// register custom acl data
StarboundLog\Library\MyAcl::register();