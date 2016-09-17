<?php
/**
* Create_config.php
*
* Create the config file
*
* PHP Version 7.0.8
*
* @category Config
* @author   isma91 <ismaydogmus@gmail.com>
* @license  https://opensource.org/licenses/mit-license.php MIT License
*/
$config = "<?php
return [
	'databases' => [
		'home' => [
			'host' => '" . $_POST["host"] . "',
			'dbname' => '" . $_POST["database_name"] . "',
			'user' => '" . $_POST["username"] . "',
			'password' => '" . $_POST["password"] . "',
		],
	],
	'install' => true
];";
$config_file = file_put_contents("../config.php", $config);
echo $config_file;
?>