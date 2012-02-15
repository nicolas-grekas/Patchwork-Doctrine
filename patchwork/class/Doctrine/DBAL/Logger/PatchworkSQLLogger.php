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

namespace Doctrine\DBAL\Logger;

use Doctrine\DBAL\Logging\SQLLogger;

/**
 * A SQL logger that logs queries and parameters to the Patchwork debug window.
 */
class PatchworkSQLLogger implements SQLLogger
{
    protected $queryInfo;

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->queryInfo = array(
            'sql'    => $sql,
            'params' => $params,
            'types'  => $types,
            'executionMS' => microtime(true),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery()
    {
        $this->queryInfo['executionMS'] = (microtime(true) - $this->queryInfo['executionMS']) * 1000;
        \Patchwork::log('sql', $this->queryInfo);
        $this->queryInfo = array();
    }
}
