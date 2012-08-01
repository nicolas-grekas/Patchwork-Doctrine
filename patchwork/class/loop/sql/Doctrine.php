<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

class loop_sql_Doctrine extends loop
{
    protected

    $db = false,
    $sql,
    $result,
    $from,
    $count;


    function __construct($sql, $filter = '', $from = null, $count = null)
    {
        $this->sql = $sql;
        $this->from = (int) $from;
        $this->count = (int) $count;
        $this->addFilter($filter);
    }

    function setLimit($from, $count)
    {
        $this->from = $from;
        $this->count = $count;
    }

    protected function prepare()
    {
        $sql = $this->sql;
        $this->db || $this->db = DB();

        if ($this->count)
        {
            $sql = $this->db->getDatabasePlatform()->modifyLimitQuery($sql, $this->count, $this->from);
        }

        $this->result = $this->db->query($sql);

        return $this->result->rowCount();
    }

    protected function next()
    {
        $a = $this->result->fetch(PDO::FETCH_OBJ);

        if ($a) return $a;
        else $this->result->closeCursor();
    }
}
