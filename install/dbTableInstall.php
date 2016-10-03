<?php
/**
* dbTableInstall.php
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
    $eventArray = array("success" => array(), "error" => array());
    $db = new PDO("mysql:host=" . $_POST["host"] . ";dbname=" . $_POST["dbname"], $_POST["username"], $_POST["dbPassword"]);
    $sqlCreateClass = "CREATE TABLE IF NOT EXISTS `class` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` int(11) NOT NULL,
            `year` int(11) NOT NULL,
            `city` int(11) NOT NULL,
            `country` int(11) NOT NULL);";
    $sqlCreateModule = "CREATE TABLE IF NOT EXISTS `modules` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `status` text NOT NULL,
            `semester` text NOT NULL,
            `date` text NOT NULL,
            `credits` int(11) NOT NULL,
            `class` int(11) NOT NULL);";
    $sqlCreatePairs = "CREATE TABLE IF NOT EXISTS `pairs` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` text NOT NULL,
            `users` text NOT NULL,
            `project` int(11) NOT NULL);";
    $sqlCreateProjects = "CREATE TABLE IF NOT EXISTS `projects` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` text NOT NULL,
            `module` int(11) NOT NULL,
            `type` text NOT NULL,
            `documents` text NOT NULL,
            `date` text NOT NULL);";
    $sqlCreateUser = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `lastname` text NOT NULL,
            `firstname` text NOT NULL,
            `username` text NOT NULL,
            `password` text NOT NULL,
            `email` text NOT NULL,
            `role` text NOT NULL,
            `log` text,
            `credits` int(11) NOT NULL DEFAULT '0',
            `class` text,
            `modules` text,
            `projects` text,
            `flags` text,
            `pairs` text,
            `absences` text,
            `documents` text,
            `token` text);";
    $sqlCreateAdmin = "INSERT INTO `users`(`lastname`, `firstname`, `username`, `password`, `email`, `role`) VALUES ('" . $_POST["lastname"] . "', '" . $_POST["firstname"] . "', '" . $_POST["nickname"] . "', '" . password_hash($_POST["password"], PASSWORD_DEFAULT) . "', '" . $_POST["email"] . "', 'admin')";
    $sqlArrayCreateTable = array("class" => $sqlCreateClass, "module" => $sqlCreateModule, "pair" => $sqlCreatePairs, "project" => $sqlCreateProjects, "user" => $sqlCreateUser, "admin" => $sqlCreateAdmin);
    foreach ($sqlArrayCreateTable as $tableName => $sqlCreateTable) {
        $tableCreate = $db->exec($sqlCreateTable);
        if ($tableName !== "admin") {
            if ($tableCreate === 0) {
                $eventArray["success"][] = $tableName;
            } else {
                $eventArray["error"][] = $tableName;
            }
        } else {
            if ($tableCreate === 1) {
                $eventArray["success"][] = $tableName;
            } else {
                $eventArray["error"][] = $tableName;
            }
        }
    }
    echo json_encode($eventArray);
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