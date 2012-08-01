<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

namespace Doctrine\DBAL;

class Connection extends self
{
    public function delete($tableName, array $identifier)
    {
        list($tableName, $identifier) = $this->_platform->quoteArgsAsIdentifiers($tableName, $identifier);

        return parent::delete($tableName, $identifier);
    }

    public function update($tableName, array $data, array $identifier, array $types = array())
    {
        list($tableName, $data, $identifier, $types) = $this->_platform->quoteArgsAsIdentifiers($tableName, $data, $identifier, $types);

        return parent::update($tableName, $data, $identifier);
    }

    public function insert($tableName, array $data, array $types = array())
    {
        list($tableName, $data, $types) = $this->_platform->quoteArgsAsIdentifiers($tableName, $data, $types);

        return parent::insert($tableName, $data);
    }
}
