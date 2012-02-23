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

namespace Doctrine\Common\Annotations;

final class AnnotationRegistry
{
    static public function reset()
    {
    }

    static public function registerFile($file)
    {
        // Disabled and replaced by Patchwork's autoloader
    }

    static public function registerAutoloadNamespace($namespace, $dirs = null)
    {
        user_error(__METHOD__ . "() is disabled and replaced by Patchwork's autoloader", E_USER_NOTICE);
    }

    static public function registerAutoloadNamespaces(array $namespaces)
    {
        user_error(__METHOD__ . "() is disabled and replaced by Patchwork's autoloader", E_USER_NOTICE);
    }

    static public function registerLoader($callabale)
    {
        user_error(__METHOD__ . "() is disabled and replaced by Patchwork's autoloader", E_USER_NOTICE);
    }

    static public function loadAnnotationClass($class)
    {
        return class_exists($class);
    }
}
