<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <?php $navbar_index = "home";?>
</head>

<body>
<header>
    <div class="header_image">
        <h3>Schülerfirma</h3>
        <div class="header_title">
            <h1>Art & Weise</h1>
        </div>
        <button class="button_more">Mehr Erfahren!</button>
    </div>
</header>

<?php require '../views/layout/navbar.php'; ?>
<div class="container content">
    <div class="recommended">
        <div class="intro">
            <h2 class="text-center">Beliebt</h2>
            <p class="text-center">Eine Auswahl der beliebtesten Produkte</p>
        </div>

        <?php
        include __DIR__ . '/./layout/productsRow.php';
        ?>

        <a href="/products">
            <button class="more_items_button">Weitere</button>
        </a>
    </div>
</div>

<?php require '../views/layout/footer.php'; ?>

</body>
<script src="/assets/js/jquery-3.6.0.min.js"></script>
<script src="/assets/js/index.js"></script>
</html>