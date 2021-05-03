<?php

namespace Database;
use PDO;
use PDOException;

require __DIR__ . '/config.php';


try{
   return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USERNAME, DB_PASSWORD);
}catch (PDOException $e){
   die("Cant connect to the database!");
}