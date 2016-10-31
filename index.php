<?php
session_start();
$configFile = include('config.php');
if (empty($configFile) || $configFile['install'] === false) {
    header('Location: ./install/install.php');
} else {
    include './view/login.php';
}
require 'autoload.php';