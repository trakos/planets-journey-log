#!/usr/bin/env php

<?php
    require(__DIR__ . '/init.php');
    \Doctrine\ORM\Tools\Console\ConsoleRunner::run(new \Symfony\Component\Console\Helper\HelperSet(array(
        'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper(StarboundLog::getEntityManager()->getConnection()),
        'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper(StarboundLog::getEntityManager())
    )));
