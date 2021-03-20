<?php

if (session_status() === 1) {
    session_start();
}
if(isset($_SESSION['userid'])) {
    $pdo = require 'connect.php';

    $statement = $pdo->query("SELECT email, forename, surname FROM `User` WHERE user_ID = {$_SESSION['userid']}");
    $loggedIn = $statement->fetch();
}
else {
    $loggedIn = false;
}