<?php
/**
* Install_db.php
*
* Create the database
*
* PHP Version 7.0.8
*
* @category Model
* @author   isma91 <ismaydogmus@gmail.com>
* @license  https://opensource.org/licenses/mit-license.php MIT License
*/
$duplicateDb = false;
try {
	$db = new PDO("mysql:host=" . $_POST["host"] . ";", $_POST["username"], $_POST["password"]);
	$dbRequest = $db->prepare("SHOW DATABASES;");
	$dbRequest->execute();
	$dbData = $dbRequest->fetchAll();
	foreach ($dbData as $value) {
		if ($value["Database"] === $_POST["dbname"]) {
			$duplicateDb = true;
			break;
		}
	}
	if ($duplicateDb === true) {
		echo "Error !! The database '" . $_POST["dbname"] . "' already exist !!\n";
	} else {
		$db->exec("CREATE DATABASE IF NOT EXISTS `" . $_POST["dbname"] . "`;");
		echo "Database '" . $_POST["dbname"] . "' successfully created !!\n";
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
        } else {    
            echo "Error !! " . $exception->getMessage();
        }
    }
?>