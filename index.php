<?php
session_start();
require 'autoload.php';
/*
 * If there is no selected language, we choose the fr
 */
//$_SESSION["lang"] = "fr";
if (!isset($_SESSION["lang"])) {
    $_SESSION["lang"] = "fr";
}
$configFile = include('./config.php');
$router = new \routing\Router($_GET["url"]);
/*
 * long condition to check if the config file is truly empty, can grow with time
 */
if (!file_exists("./config.php") || empty($configFile) || !is_array($configFile) || empty($configFile["install"]) || $configFile['install'] === false) {
    header('Location: ./install/install.php');
} else {
    $router = new \routing\Router($_GET["url"]);
    $router->get("/", "site#login");
    /*
     * Run the routing System
     */
    $router->run();
}
