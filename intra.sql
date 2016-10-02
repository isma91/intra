/**
* Intra.sql
*
* The SQL file of the intra database
* You can import it if the instalator doesn't create in your database.
*
* MySQL 5.7.15
*
* @category Database
* @author   isma91 <ismaydogmus@gmail.com>
* @license  https://opensource.org/licenses/mit-license.php MIT License
*/
CREATE DATABASE `ìntra`;
USE `ìntra`;
CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `country` int(11) NOT NULL
);
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status` text NOT NULL,
  `semester` text NOT NULL,
  `date` text NOT NULL,
  `credits` int(11) NOT NULL,
  `class` int(11) NOT NULL
);
CREATE TABLE IF NOT EXISTS `pairs` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` text NOT NULL,
  `users` text NOT NULL,
  `project` int(11) NOT NULL
);
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` text NOT NULL,
  `module` int(11) NOT NULL,
  `type` text NOT NULL,
  `documents` text NOT NULL,
  `date` text NOT NULL
);
CREATE TABLE IF NOT EXISTS `users` (
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
  `token` text
);