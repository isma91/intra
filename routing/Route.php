<?php
/**
 * Route.php
 *
 * Represent a route with method and callable function
 *
 * PHP 7.0.10
 *
 * @category Routing
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace routing;

class Route
{
    private $_path;
    private $_func;
    private $_matches;
    private $_params = array();

    public function __construct($path, $func)
    {
        $this->_path = trim($path, '/');
        $this->_func = $func;
    }

    public function with($param, $regex)
    {
        $this->_params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, '_paramMatch'], $this->_path);
        if (!preg_match("#^$path$#i", $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->_matches = $matches;
        return true;
    }

    private function _paramMatch($match)
    {
        if (isset($this->_params[$match[1]])) {
            return '(' . $this->_params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

    public function call()
    {
        if (is_string($this->_func)) {
            $params = explode('#', $this->_func);
            $controllerName = "controller\\" . $params[0] . "Controller";
            $controller = new $controllerName();
            $action = $params[1];
            return call_user_func_array([$controller, $action], $this->_matches);
        } else {
            return call_user_func_array($this->_func, $this->_matches);
        }
    }

    public function getUrl($params)
    {
        $path = $this->_path;
        foreach ($params as $find => $replace) {
            $path = str_replace(":$find", $replace, $path);
        }
        return $path;
    }
}