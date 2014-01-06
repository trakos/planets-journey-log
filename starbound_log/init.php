<?php

chdir(__DIR__);

define('T_PATH_APPLICATION', __DIR__);
define('T_PATH_LIB', '/var/www/phpinclude');

define('T_PATH_ZEND2', T_PATH_LIB . '/Zend');
define('T_PATH_CONFIG', T_PATH_APPLICATION . '/config');
define('T_PATH_MAIL_VIEW', T_PATH_APPLICATION . '/view/_mail');

define('T_PATH_ZEND_SERVICE', T_PATH_LIB . '/ZendService');
define('T_PATH_SYMFONY', T_PATH_LIB . '/Symfony');
define('T_PATH_DOCTRINE', T_PATH_LIB . '/Doctrine');
define('T_PATH_TRKS', T_PATH_LIB . '/Trks');
define('T_PATH_APP_SRC', T_PATH_APPLICATION . '/StarboundLog');
define('T_PATH_MODULES', T_PATH_APPLICATION . '/StarboundLog/Controller/');

define('T_NAMESPACE_ZEND_SERVICE', 'ZendService');
define('T_NAMESPACE_DOCTRINE', 'Doctrine');
define('T_NAMESPACE_SYMFONY', 'Symfony');
define('T_NAMESPACE_TRKS', 'Trks');
define('T_NAMESPACE_APP_SRC', 'StarboundLog');
define('T_NAMESPACE_MODULES', 'StarboundLog\\Controller');

define('T_PATH_ENTITIES', T_PATH_APP_SRC . '/Model/Entities');

define('T_PATH_CONFIG_GLOB_ZEND', T_PATH_CONFIG . '/zend/*.config.php');
define('T_PATH_CONFIG_GLOB_CUSTOM', T_PATH_CONFIG . '/custom/*.config.php');
define('T_PATH_CONFIG_CUSTOM_CACHE', T_PATH_CONFIG . '/custom_config_cache.php');

define('T_DATETIME_FORMAT_MYSQL', 'Y-m-d H:i:s');

/** @noinspection PhpIncludeInspection */
require T_PATH_ZEND2 . '/Loader/StandardAutoloader.php';
require T_PATH_APPLICATION . '/StarboundLog/StarboundLog.php';

// autoloader
(new Zend\Loader\StandardAutoloader())
    ->setOptions(array(
        'autoregister_zf' => true
    ))
    ->registerNamespace(T_NAMESPACE_ZEND_SERVICE, T_PATH_ZEND_SERVICE)
    ->registerNamespace(T_NAMESPACE_SYMFONY, T_PATH_SYMFONY)
    ->registerNamespace(T_NAMESPACE_DOCTRINE, T_PATH_DOCTRINE)
    ->registerNamespace(T_NAMESPACE_TRKS, T_PATH_TRKS)
    ->registerNamespace(T_NAMESPACE_APP_SRC, T_PATH_APP_SRC)
    ->register();

// debug
define('T_DEBUG', T_PATH_APPLICATION == "/var/www/dev/starbound_log_dev");
if (T_DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set('html_errors', false);
}

// custom configs - we need it before creating zend app (we're using controllers_structure there already)
StarboundLog::init((new \Trks\Util\TrksMergedConfig(T_PATH_CONFIG_GLOB_CUSTOM, T_PATH_CONFIG_CUSTOM_CACHE, !T_DEBUG))->getMergedConfig());




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
            T_PATH_CONFIG_GLOB_ZEND,
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => StarboundLog::getModulesViewPaths()
    )
)));
