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

class adapter_DB
{
    protected static $db = array();

    static function connect($dsn)
    {
        $db = md5(serialize(';', $dsn));

        if (isset(self::$db[$db])) return self::$db[$db];

        $db =& self::$db[$db];
        $db = \Doctrine\DBAL\DriverManager::getConnection(
            $dsn,
            self::createConfiguration($dsn),
            self::createEventManager($dsn)
        );
        $db->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        $db->setCharset('utf8');

        return $db;
    }

    protected static function createConfiguration($dsn)
    {
        $conf = new \Doctrine\DBAL\Configuration();

        if (!empty($CONFIG['doctrine.dbal.logger']))
        {
            $conf->setSQLLogger(new $CONFIG['doctrine.dbal.logger']);
        }

        return $conf;
    }

    protected static function createEventManager($dsn)
    {
        $evm = new \Doctrine\Common\EventManager();

        if (!empty($CONFIG['doctrine.event.listeners']))
        {
            foreach ($CONFIG['doctrine.event.listeners'] as $listener)
            {
                $evm->addEventSubscriber(new $listener());
            }
        }

        return $evm;
    }

    static function disconnect($db)
    {
        $db->close();
    }

    static function __free()
    {
        foreach (self::$db as $db) self::disconnect($db);

        self::$db = array();
    }
}
