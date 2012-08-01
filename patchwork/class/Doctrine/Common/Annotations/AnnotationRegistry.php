<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
/*
 * Copyright (C) 2012 Nicolas Grekas - p@tchwork.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

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
