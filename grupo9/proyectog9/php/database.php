<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'lessmodb';
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
?>
