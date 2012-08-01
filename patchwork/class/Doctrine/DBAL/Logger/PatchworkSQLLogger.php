<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

namespace Doctrine\DBAL\Logger;

use Doctrine\DBAL\Logging\SQLLogger;

/**
 * A SQL logger that logs queries and parameters to the Patchwork debug window.
 */
class PatchworkSQLLogger implements SQLLogger
{
    protected $queryInfo = array();

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->queryInfo = array(
            'query' => $sql,
            'time-ms' => 0,
        );

        empty($params) or $this->queryInfo['params'] = $params;
        empty($types) or $this->queryInfo['types'] = $types;

        $this->queryInfo['time-ms'] = microtime(true);
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery()
    {
        $this->queryInfo['time-ms'] = sprintf('.3f', (microtime(true) - $this->queryInfo['time-ms']) * 1000);
        \Patchwork::log('sql', $this->queryInfo);
        $this->queryInfo = array();
    }
}
