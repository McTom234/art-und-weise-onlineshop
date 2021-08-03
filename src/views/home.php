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
    <div>
        <h4>Schülerfirma</h4>
        <h1>Art & Weise</h1>
    </div>
    <button class="button_more">Mehr Erfahren!</button>
</header>

<?php require 'layout/navbar.php'; ?>
<main>
    <section class="recommended">
        <div class="intro">
            <h3>Beliebte Produkte</h3>
            <p>Die Auswahl unserer beliebtesten Produkte aus unserem Online-Shop.</p>
        </div>

        <?php
        require 'layout/productsRow.php';
        ?>

        <a class="link-button more-items" href="/products">Weitere</a>
    </section>
</main>

<?php require 'layout/footer.php'; ?>

</body>
<script src="/assets/js/jquery-3.6.0.min.js"></script>
<script src="/assets/js/index.js"></script>
</html>