<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

class pForm_select extends self
{
    protected $entityClass = null;

    protected function init(&$param)
    {
        if (isset($param['entityClass']))
        {
            $this->entityClass = $param['entityClass'];
        }

        if (isset($param['query']))
        {
            $param['loop'] = new loop_array(
                $param['query']->getResult(),
                'filter_rawArray'
            );
        }

        return parent::init($param);
    }

    function getDbValue()
    {
        return ($this->entityClass && $v = $this->getValue())
            ? EM()->getReference($this->entityClass, $v)
            : parent::getDbValue();
    }
}
