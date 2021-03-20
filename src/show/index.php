<?php
$pdo = require 'database/connect.php';
require 'database/authentication.php';

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="css/home.css">
</head>

<body>

<?php require 'components/navbar.php';?>

<?
if(isset($_GET['id'])) {

    $id = array(
        ':id' => $_GET['id']
    );

    $statement = $pdo->prepare("SELECT * FROM products WHERE id = : id");
    $product = $statement->execute($id);

?>

<div class="product_view">
    <h1><?php $product['name'] ?></h1>
    <p><?php $product['description'] ?></p>
</div>

<?php }else{ ?>

<?php} ?>

<?php require 'components/footer.php';?>

</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/index.js"></script>
</html>