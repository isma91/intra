<?php
/**
* Install_import_db.php
*
* Create tables and the admin who can create class, teacher, student, module, project etc in the selected database
*
* PHP Version 7.0.8
*
* @category Model
* @author   isma91 <ismaydogmus@gmail.com>
* @license  https://opensource.org/licenses/mit-license.php MIT License
*/
try {
	$db = new PDO("mysql:host=" . $_POST["host"] . ";dbname=" . $_POST["dbname"], $_POST["username"], $_POST["password"]);
	$sql = "INSERT INTO `users`(`id`, `name`, `firstname`, `lastname`, `email`, `password`, `token`, `created_at`, `updated_at`, `active`)
		VALUES ('1','" . $_POST["blogger_name"] . "','" . $_POST["blogger_firstname"] . "','" . $_POST["blogger_lastname"] . "','" . $_POST["blogger_email"] . "','" . password_hash($_POST["blogger_password"], PASSWORD_DEFAULT) . "','',NOW(),'','1')";
		$tableCreate = $db->exec($sql);
		if ($tableCreate === 0) {
			echo "true";
		} else {
			echo "false";
		}
} catch (PDOException $exception) {
	if ($exception->getCode() === 2005) {
		echo "Error !! The MySQL server '" . $_POST["host"] . "' is not recognized !!\n";
	} elseif ($exception->getCode() === 1045) {
		if ($_POST["password"] === "") {
			echo "Error !! The MySQL server denied acces to '" . $_POST["username"] . "', maybe you forgot to write the password ??\n";
		} else {
			echo "Error !! The MySQL server denied acces to '" . $_POST["username"] . "', maybe you have write the wrong password ??\n";
		}
	} elseif ($exception->getCode() === 1049) {
		echo "Error !! Database '" . $_POST["dbname"] . "' doesn't exist in the MySQL server '" . $_POST["host"] . "'\n";
	} else {    
		echo "Error !! " . $exception->getMessage();
	}
}
?>