<?php

chdir(__DIR__);

define('T_PATH_APPLICATION', __DIR__);
define('T_PATH_LIB', '/var/www/phpinclude');

define('T_PATH_ZEND2', T_PATH_LIB . '/Zend');
define('T_PATH_CONFIG', T_PATH_APPLICATION . '/config');

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

// debug
define('T_DEBUG', T_PATH_APPLICATION == "/var/www/dev/starbound_log_dev");
if (T_DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set('html_errors', false);
}

// doctrine
StarboundLog::setEntityManager(
    Doctrine\ORM\EntityManager::create(
        require_once(T_PATH_CONFIG . '/doctrine/database.config.php'),
        Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            array(T_PATH_ENTITIES),
            T_DEBUG,
            null,
            null,
            false
        )
    )
);