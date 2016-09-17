<?php
/**
* Test_db.php
*
* Test if the database is successfully connected
*
* PHP Version 7.0.8
*
* @category Testing
* @author   isma91 <ismaydogmus@gmail.com>
* @license  https://opensource.org/licenses/mit-license.php MIT License
*/
try {
	$db = new PDO("mysql:host=" . $_POST["host"] . ";dbname=" . $_POST["dbname"], $_POST["username"], $_POST["password"]);
	$tableRequest = $bdd->query("SHOW TABLES");
    $tableData = $tableRequest->fetchAll(PDO::FETCH_NUM);
    if (count($tableData) === 0) {
    	echo "The database '" . $_POST["dbname"] . "' is empty !! You can finish the installation now !!\n";
    } else {
    	echo "Error !! The database '" . $_POST["dbname"] . "' is not empty !!\n";
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