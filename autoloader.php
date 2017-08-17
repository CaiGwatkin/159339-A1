<?php
/* GWATKIN 15146508 A1 */

/**
 * Autoloader function file.
 *
 * PHP version 7.1
 *
 * @package     cgwatkin\A1
 * @author      Cai Gwatkin <caigwatkin@gmail.com>
 * @license     https://opensource.org/licenses/MIT  The MIT License
 */

namespace cgwatkin\A1;

/**
 * Autoloader for classes within the cgwatkin\A1 package.
 *
 * Ensures classes used within cgwatkin\A1 package are "required." Modified from PSR-4 example code.
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class)
{
    $prefix = 'cgwatkin\\A1\\';
    $base_dir = __DIR__ . '/src/A1/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});
