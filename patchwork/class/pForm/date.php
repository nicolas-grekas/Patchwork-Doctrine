<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

class pForm_date extends self
{
    protected $toDateTime;

    protected function init(&$param)
    {
        if (isset($param['toDateTime']))
        {
            $this->toDateTime = (bool) $param['toDateTime'];
        }
        else
        {
            $this->toDateTime = !empty($CONFIG['pForm.date.toDateTime']);
        }

        parent::init($param);
    }

    function setValue($value)
    {
        $value instanceof DateTime and $value = $value->format('Y-m-d');
        return parent::setValue($value);
    }

    function getDbValue()
    {
        $v = parent::getDbValue();
        $this->toDateTime and $v = $v ? new DateTime($v) : null;
        return $v;
    }
}
