<?php

return array(
    'db'              => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=starbound_log_dev;host=localhost',
        'user'           => 'starbound',
        'password'       => 'starbound',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);