<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <?php $navbar_index = "home"; ?>
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

    <?php foreach ($categories as $category): ?>
        <?php if (count($category->products) >= 3): ?>
            <section class="recommended">
                <div class="intro">
                    <h3><?= $category->name ?></h3>
                    <p>Eine Auswahl von Produkten aus der Kategorie <?= $category->name ?>.</p>
                </div>

                <?php
                $products = $category->products;
                require 'layout/productsRow.php';
                ?>

                <a class="link-button more-items" href="/products?c=<?= $category->category_ID ?>">Weitere</a>
            </section>
        <?php endif; endforeach; ?>
</main>

<?php require 'layout/footer.php'; ?>

<script src="/assets/js/jquery-3.6.0.min.js"></script>
<script src="/assets/js/index.js"></script>
</body>
</html>