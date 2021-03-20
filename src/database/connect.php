<?php
$database = require('config/config.php');
$host = $database['db']['host'];
$dbname = $database['db']['dbname'];
$user = $database['db']['username'];
$password = $database['db']['password'];
return new PDO("mysql:host={$host};dbname={$dbname}", $user, $password);