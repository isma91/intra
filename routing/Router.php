<?php
/**
 * Router.php
 *
 * Add the url to match and take link with the Route model
 *
 * PHP 7.0.10
 *
 * @category Routing
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace routing;

use model\Config;
use model\View;

class Router
{
    private $_url;
    private $_routes = array();
    private $_namedRoutes = array();

    public function __construct($url)
    {
        $this->_url = $url;
    }

    public function get($path, $func, $name = null)
    {
        return $this->_add($path, $func, $name, 'GET');
    }

    public function post($path, $func, $name = null)
    {
        return $this->_add($path, $func, $name, 'POST');
    }

    private function _add($path, $func, $name, $method)
    {
        $route = new Route($path, $func);
        $this->_routes[$method][] = $route;
        if (is_string($func) && $name === null) {
            $name = $func;
        }
        if ($name) {
            $this->_namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run()
    {
        $routeMatch = false;
        foreach ($this->_routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->_url)) {
                $routeMatch = true;
                break;
            }
        }
        if ($routeMatch === true) {
            return $route->call();
        } else {
            $view = new View("site#404");
            $view->render();
            return false;
        }
    }

    public function url($name, $params = array())
    {
        if (!isset($this->_namedRoutes[$name])) {
            $view = new View("site#404");
            $view->render();
            return false;
        }
        return $this->_namedRoutes[$name]->getUrl($params);
    }
}