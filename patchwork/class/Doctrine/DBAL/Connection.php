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
