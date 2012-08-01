<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

class adapter_EM extends adapter_DB
{
    protected static $em = array();

    static function connect($dsn)
    {
        empty($dsn) and $dsn = self::getDefaultDsn();
        $h = md5(serialize($dsn), true);
        if (isset(self::$em[$h])) return self::$em[$h];

        return self::$em[$h] = \Doctrine\ORM\EntityManager::create(
            adapter_DB::connect($dsn),
            self::createConfiguration($dsn)
        );
    }

    protected static function createConfiguration($dsn)
    {
        $conf = new \Doctrine\ORM\Configuration();

        $cache = new $CONFIG['doctrine.cache'];

        $conf->setQueryCacheImpl($cache);
        $conf->setMetadataCacheImpl($cache);
        $conf->setMetadataDriverImpl($conf->newDefaultAnnotationDriver(array(patchworkPath($CONFIG['doctrine.entities.dir']))));
        $conf->setProxyDir(patchworkPath($CONFIG['doctrine.proxy.dir']));
        $conf->setAutoGenerateProxyClasses($CONFIG['doctrine.proxy.generate']);
        $conf->setProxyNamespace($CONFIG['doctrine.proxy.namespace']);

        return $conf;
    }
}
