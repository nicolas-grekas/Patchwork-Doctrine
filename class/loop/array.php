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
