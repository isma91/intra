<?php
session_start();
if (!file_exists('config.php')) {
    header('Location: ./install/install.php');
}
require 'autoload.php';