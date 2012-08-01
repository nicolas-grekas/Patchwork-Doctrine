<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

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
