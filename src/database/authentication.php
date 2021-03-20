<?php

if (session_status() === 1) {
    session_start();
}
if(isset($_SESSION['userid'])) {
    $database = include('config/config.php');
    $host = $database['host'];
    $dbname = $database['dbname'];
    $user = $database['user'];
    $password = $database['password'];
    $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $user, $password);

    $statement = $pdo->query("SELECT email FROM `User` WHERE user_ID = {$_SESSION['userid']}");
    $result = $statement->fetch();

    if($result){
        echo "eingelogt als " . $result["forename"] . $result["surname"];
    }


}