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

namespace Doctrine\DBAL\Platforms;

abstract class AbstractPlatform extends self
{
    protected $identifierQuoteCharacter;


    /**
     * Quotes its arguments as identifiers.
     *
     * @return array quoted arguments
     */
    public function quoteArgsAsIdentifiers()
    {
        $a = func_get_args();

        if (isset($this->identifierQuoteCharacter))
        {
            $q = $this->identifierQuoteCharacter;
        }
        else
        {
            $q = $this->quoteSingleIdentifier('q');
            $q = $this->identifierQuoteCharacter = $q[0];
        }

        foreach ($a as &$data)
        {
            if (is_string($data))
            {
                if (isset($data[0]) && $q !== $data[0])
                {
                    $data = $this->quoteIdentifier($data);
                }
            }
            else
            {
                $quotedData = array();

                foreach ($data as $k => $v)
                {
                    if (isset($k[0]) && $q !== $k[0])
                    {
                        $k = $this->quoteIdentifier($k);
                    }

                    $quotedData[$k] = $v;
                }

                $data = $quotedData;
            }
        }

        return $a;
    }
}
