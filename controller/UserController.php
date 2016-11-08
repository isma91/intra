<?php
namespace controller;
/**
 * UserController.php
 *
 * File to control User
 *
 * PHP 7.0.8
 *
 * @category Model
 * @package  Model
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
use model\Bdd;
use model\Config;
use model\Message;
use model\SiteInfo;
use model\User;
use model\View;
/**
 * UserController
 *
 * Class to control all the User stuff
 *
 * PHP 7.0.10
 *
 * @category Class
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */
class UserController
{
    /**
     * RedirectIfLogged
     *
     * Redirect to the home page if already logged
     *
     * @param string; $viewName the page name
     * @param array;  $arraySet the item value array to display in the view
     *
     * @return void; the View
     */
    public function redirectIfLogged($viewName, $arraySet = array())
    {
        $userClass = new User();
        $connected = User::is_connected();
        $message = new Message();
        $messages = $message->getMessages();
        if ($connected === true) {
            $view = new View("admin#panel");
            $user = $userClass->getUser();
            if ($user !== false) {
                foreach ($user as $name => $value) {
                    $view->set($name, $value);
                }
            }
            $view->set("error", $messages["error"]["mustNotBeConnected"]);
            $view->render();
        } else {
            $view = new View($viewName);
            if (!empty($arraySet)) {
                foreach ($arraySet as $name => $value) {
                    $view->set($name, $value);
                }
            }
            $view->render();
        }
    }

    /**
     * RedirectIfNotLogged
     *
     * Redirect to the login if not logged
     *
     * @param string; $viewName the page name
     * @param array;  $arraySet the item value array to display in the view
     *
     * @return void; the View
     */
    public function redirectIfNotLogged($viewName, $arraySet = array())
    {
        $userClass = new User();
        $connected = User::is_connected();
        $message = new Message();
        $messages = $message->getMessages();
        if ($connected === true) {
            $view = new View($viewName);
            if (!empty($arraySet)) {
                foreach ($arraySet as $name => $value) {
                    $view->set($name, $value);
                }
            }
            $view->render();
        } else {
            $view = new View("admin#login");
            $view->set("error", $messages["error"]["mustBeConnected"]);
            $view->render();
        }
    }

}