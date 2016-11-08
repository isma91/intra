<?php
/**
 * View.php
 *
 * Link the controller and the view
 *
 * PHP 7.0.8
 *
 * @category Model
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace model;
/**
 * Class View to display view
 *
 * @category Class
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */
class View
{
    protected $_file;
    protected $_data = array();

    /*
     * __construct
     *
     * We get the title and description of the site to add them as data to the view
     *
     * @param string $file the view name
     *
     * @return void;
     *
     */
    public function __construct($file)
    {
        $site = new SiteInfo();
        $this->_data["site"]["title"] = $site->getTitle();
        $this->_data["site"]["description"] = $site->getDescription();
        $config = new Config();
        $message = new Message();
        $messages = $message->getMessages();
        if ($config->getMaintenance() === 'true') {
            $this->_data["site"]["info"] = $messages["info"]["maintenance"];
        } else {
            $this->_data["site"]["info"] = null;
        }
        $this->_file = $file;
    }

    /*
     * Set
     *
     * Add data in the view
     *
     * @param string; $key   the name of the item
     * @param string; $value the value of the item
     *
     * @return void;
     */
    public function set($key, $value)
    {
        $this->_data[$key] = $value;
    }

    /*
     * Get
     *
     * Get the value of a selected item
     *
     * @param string $key; the name of the item
     *
     * @return mixed;
     */
    public function get($key)
    {
        return $this->_data[$key];
    }

    /**
     * @param $name
     * @return array|mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
    }

    /*
     * Render
     *
     * Display the view with the value of all data in his view
     *
     * @return void;
     */
    public function render()
    {
        /*
         * We get the folder + file name
         */
        $folderFile = explode('#', $this->_file);
        /*
         * We try to have how many slash '/' we gonna add to get the statics files
         */
        $arrayRequestUri = explode("/", ltrim($_SERVER["REQUEST_URI"], "/"));
        $pathCount = count($arrayRequestUri);
        if ($pathCount === 1 && count($folderFile) > 1) {
            $pathCount = 2;
        }
        $cssPath = "";
        if ($pathCount === 0) {
            $cssPath = "css" . "/";
        } elseif ($pathCount > 0) {
            for ($i = 0; $i < $pathCount; $i = $i + 1) {
                $cssPath = $cssPath . ".." . "/";
            }
            $cssPath = $cssPath . "media/css/";
        }
        $jsPath = "";
        if ($pathCount === 0) {
            $jsPath = "js" . "/";
        } elseif ($pathCount > 0) {
            for ($j = 0; $j < $pathCount; $j = $j + 1) {
                $jsPath = $jsPath . ".." . "/";
            }
            $jsPath = $jsPath . "media/js/";
        }
        $imgPath = "";
        if ($pathCount === 0) {
            $imgPath = "img" . "/";
        } elseif ($pathCount > 0) {
            for ($l = 0; $l < $pathCount; $l = $l + 1) {
                $imgPath = $imgPath . ".." . "/";
            }
            $imgPath = $imgPath . "media/img/";
        }
        /*
         * css/js/img statics files who are charged in all views
         */
        $cssAssets = array(
            "mui.min.css",
            "materialize.min.css",
            "google_material_icons.css",
            "font.css",
            "style.css",
        );
        $jsAssets = array(
            "jquery-2.1.4.min.js",
            "mui.min.js",
            "materialize.min.js",
            "switchLanguage.js",
            "logout.js",
        );
        $imgAssets = array();
        /*
         * For the i18n, we get the file in the language name folder
         */
        $file = rtrim(__DIR__, '/') . "/" . "../view/" . $_SESSION["lang"] . "/";
        for ($k = 0; $k < $pathCount; $k = $k + 1) {
            if ($k === $pathCount - 1) {
                if (!isset($folderFile[$k])) {
                    $file = substr($file, 0, -1) . ".php";
                } else {
                    $file = $file . $folderFile[$k] . ".php";
                }
            } else {
                if (!isset($folderFile[$k])) {
                    $file = $file . $folderFile[$k] . "";
                } else {
                    $file = $file . $folderFile[$k] . "/";
                }
            }
        }
        $jsFileName = "";
        foreach ($folderFile as $path) {
            $jsFileName = $jsFileName . "/" . $path;
        }
        $jsFileName = ltrim($jsFileName, "/") . ".js";
        $jsFileNamePath = rtrim(__DIR__, '/') . "/../media/js/" . $jsFileName;
        /*
         * If we have a js file who have the same folder + file name we add it
         * Ex: you have the admin/panel view, if we have a panel.js file in "media/js/admin/" we add it
         */
        if (file_exists($jsFileNamePath)) {
            array_push($jsAssets, $jsFileName);
        }
        /*
         * If the file doesn't exist we display a 404 error in the language of the user
         */
        if (!file_exists($file)) {
            $view = new View("site#404");
            $view->render();
        }
        /*
         * Add the css/js/img in the view as the html language
         */
        foreach ($cssAssets as $cssFile) {
            $this->_data["css"][] = '<link media="all" type="text/css" rel="stylesheet" href="' . $cssPath . $cssFile . '" />';
        }
        foreach ($jsAssets as $jsFile) {
            $this->_data["js"][] = '<script src="' . $jsPath . $jsFile . '"></script>';
        }
        foreach ($imgAssets as $imgName => $imgFile) {
            $this->_data["img"][$imgName] = $imgPath . $imgFile;
        }
        /*
         * If we have a "favicon.ico" file in "media/img" we add it
         */
        if (file_exists("../media/img/favicon.ico")) {
            $this->_data["icon"] = '<link rel="icon" href="' . $imgPath . 'favicon.ico" />';
        } else {
            $this->_data["icon"] = '';
        }
        extract($this->_data);
        ob_start();
        include($file);
        $output = ob_get_contents();
        ob_end_clean();
        /*
         * Display the view
         */
        echo $output;
    }
}