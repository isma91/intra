<?php
/**
 * Autoload.php
 *
 * PHP Version 7.0.8
 *
 * @category Controller
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  https://opensource.org/licenses/mit-license.php MIT License
 */
function autoload($class) {
	$class = str_replace('\\', '/', $class);
    include $class . '.php';
}

spl_autoload_register('autoload');