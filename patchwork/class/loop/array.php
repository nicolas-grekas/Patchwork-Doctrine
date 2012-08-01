<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

class loop_array extends self
{
    function __construct($array, $filter = '', $isAssociative = null)
    {
        parent::__construct($array, $filter, $isAssociative);

        if ('filter_rawArray' === $filter) $this->addFilter(array($this, 'filterDateTime'));
    }

    function filterDateTime($data)
    {
        foreach ($data as $k => &$v)
        {
            if ($v instanceof DateTime)
            {
                $k .= '_timestamp';
                $data->$k = $v->format('U');
                $v = $v->format('c');
            }
        }

        return $data;
    }

}
