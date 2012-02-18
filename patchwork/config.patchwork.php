<?php // vi: set fenc=utf-8 ts=4 sw=4 et:

$CONFIG += array(
//    'DSN' => array(
//        'driver' => 'pdo_mysql',
//        'host' => 'localhost',
//        'dbname' => 'database',
//        'user' => 'user',
//        'password' => 'password',
//    ),
    'doctrine.cache' => 'Doctrine\Common\Cache\ArrayCache', // Use ApcCache for production env
    'doctrine.mapping.dir' => 'data/mapping',
    'doctrine.entities.dir' => 'class/Entities',
    'doctrine.proxy.dir' => 'class/Proxies',
    'doctrine.proxy.generate' => true, // Set to false to production env
//    'doctrine.dbal.logger' => 'Doctrine\DBAL\Logger\PatchworkSQLLogger',
    'doctrine.event.listeners' => array(),
);

/**
 * @return \Doctrine\ORM\EntityManager
 */
function EM()
{
    return adapter_EM::connect($GLOBALS['CONFIG']['DSN']);
}
