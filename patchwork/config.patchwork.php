<?php // vi: set fenc=utf-8 ts=4 sw=4 et:

$CONFIG += array(
    'doctrine.driver' => 'pdo_mysql',
    'doctrine.host' => 'localhost',
    'doctrine.dbname' => 'database',
    'doctrine.user' => 'user',
    'doctrine.password' => 'password',

    'doctrine.cache' => 'Doctrine\Common\Cache\ArrayCache', // Use ApcCache for production env
    'doctrine.entities.dir' => 'class/Entities',
    'doctrine.proxy.dir' => 'class/Proxies',
    'doctrine.proxy.generate' => true, // Set to false to production env
//    'doctrine.dbal.logger' => 'Doctrine\DBAL\Logger\PatchworkSQLLogger',
    'doctrine.event.listeners' => array(),

    'pForm.date.toDateTime' => false,
);


/**
 * @return \Doctrine\ORM\EntityManager
 */
function EM($dsn = array())
{
    return adapter_EM::connect($dsn);
}

/**
 * @return \Doctrine\DBAL\Connection
 */
function DB($dsn = array())
{
    return adapter_DB::connect($dsn);
}
