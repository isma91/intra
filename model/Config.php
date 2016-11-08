<?php
/**
 * Config.php
 *
 * Class to get or set the config
 *
 * PHP 7.0.10
 *
 * @category Model
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace model;
/**
 * Class config to interface with the config file
 *
 * @category Class
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */
class Config
{
    private $_host;
    private $_dbname;
    private $_username;
    private $_password;
    private $_maintenance;

    /**
     * @return mixed
     */
    public function getMaintenance()
    {
        return $this->_maintenance;
    }

    /**
     * @param mixed $maintenance
     */
    public function setMaintenance($maintenance)
    {
        $this->_maintenance = $maintenance;
        $this->changeConfigFile('maintenance', $maintenance);
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->_host = $host;
        $this->changeConfigFile('host', $host);
    }

    /**
     * @return mixed
     */
    public function getDbname()
    {
        return $this->_dbname;
    }

    /**
     * @param mixed $dbname
     */
    public function setDbname($dbname)
    {
        $this->_dbname = $dbname;
        $this->changeConfigFile('dbname', $dbname);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        $this->changeConfigFile('user', $username);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        $this->changeConfigFile('password', $password);
    }

    /**
     * __construct
     *
     * Get all config file in the class
     */
    public function __construct()
    {
        if (file_exists("config.php")) {
            $config = include 'config.php';
        } else {
            $config = include '../config.php';
        }
        $this->_host = $config["host"];
        $this->_dbname = $config["dbname"];
        $this->_username = $config["user"];
        $this->_password = $config["password"];
        $this->_maintenance = $config["maintenance"];
    }

    /**
     * ChangeConfigFile
     *
     * Change the value of the config file
     *
     * @param string; $name  the name of the item
     * @param string; $value the value of the item
     *
     * @return void
     */
    private function changeConfigFile($name, $value)
    {
        $configPath = rtrim(__DIR__, '/') . "/" . "../config.php";
        $configFile = file_get_contents($configPath);
        $config = preg_replace("/'" . $name . "' => (.*)/", "'" . $name . "' => '" . $value . "'", $configFile);
        file_put_contents($configPath, $config);
    }
}