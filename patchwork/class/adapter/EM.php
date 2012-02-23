<?php /****************** vi: set fenc=utf-8 ts=4 sw=4 et: *****************
 *
 *   Copyright : (C) 2012 Nicolas Grekas. All rights reserved.
 *   Email     : p@tchwork.org
 *   License   : http://www.gnu.org/licenses/agpl.txt GNU/AGPL
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU Affero General Public License as
 *   published by the Free Software Foundation, either version 3 of the
 *   License, or (at your option) any later version.
 *
 ***************************************************************************/

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
