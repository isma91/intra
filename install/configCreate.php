<?php
/**
* Create_config.php
*
* Create the config file
* if you already have a current config.php in the root of the project, it gonna be overwritted
*
* PHP Version 7.0.8
*
* @category Config
* @author   isma91 <ismaydogmus@gmail.com>
* @license  https://opensource.org/licenses/mit-license.php MIT License
*/
$config = "<?php
/**
* Config.php
*
* Here is your config file,
* this file is dynamically created by the intra instalator or maybe you created this manually :D
* set install to false if you want to reinstall the intra
*
* PHP Version 7.0.8
*
* @category Config
* @author   isma91 <ismaydogmus@gmail.com>
* @license  https://opensource.org/licenses/mit-license.php MIT License
*/
return array(
    array(
        'host' => '" . $_POST["host"] ."',
		'dbname' => '" . $_POST["dbname"] ."',
		'user' => '" . $_POST["username"] ."',
		'password' => '" . $_POST["password"] ."',
    ),
	'install' => true
);";
$config_file = file_put_contents("../config.php", $config);
echo $config_file;
?>