<?php
/**
 * SiteController.php
 *
 * File to display pages
 *
 * PHP 7.0.10
 *
 * @category Controller
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace controller;
use model\Config;
use model\View;
/**
 * SiteController
 *
 * Class to control the front view of the site
 *
 * PHP 7.0.10
 *
 * @category Class
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */
class SiteController
{
    /*
     * CheckMaintenance
     *
     * Check if the site is in maintenance, display the maintenance page if needed
     *
     * @param string; $page   the page to display
     * @param array;  $array  the item value array to display in the view
     *
     * @return void; render the view
     */
    public function checkMaintenance($page, array $array = array())
    {
        $config = new Config();
        if ($config->getMaintenance() === "true") {
            $view = new View("site#maintenance");
            $view->render();
        } else {
            $view = new View($page);
            if (!empty($array)) {
                foreach ($array as $item => $value) {
                    $view->set($item, $value);
                }
            }
            $view->render();
        }
    }

    public function login()
    {
        self::checkMaintenance("site#login");
    }
}