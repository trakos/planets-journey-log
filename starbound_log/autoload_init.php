<?php

chdir(__DIR__);

define('T_PATH_APPLICATION', __DIR__ . '/');
define('T_PATH_LIB', '/var/www/phpinclude');
define('T_PATH_ZEND2', T_PATH_LIB . '/Zend');

define('T_PATH_DOCTRINE', T_PATH_LIB . '/Doctrine');
define('T_PATH_APPSRC', T_PATH_APPLICATION . '/StarboundLog');
define('T_PATH_MODULES', T_PATH_APPLICATION . '/StarboundLog/Controller/');

define('T_NAMEPSACE_DOCTRINE', 'Doctrine');
define('T_NAMESPACE_APPSRC', 'StarboundLog');
define('T_NAMESPACE_MODULES', 'StarboundLog\\Controller');

require T_PATH_ZEND2 . '/Loader/StandardAutoloader.php';
require T_PATH_APPLICATION . '/StarboundLog/StarboundLog.php';

(new Zend\Loader\StandardAutoloader())
    ->setOptions(array(
        'autoregister_zf' => true
    ))
    ->registerNamespace(T_NAMESPACE_APPSRC, T_PATH_APPSRC)
    ->registerNamespace(T_NAMEPSACE_DOCTRINE, T_PATH_DOCTRINE)
    ->register();