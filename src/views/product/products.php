<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Schülerfirma Art und Weise | Produktübersicht</title>
    <link rel="stylesheet" href="/assets/css/products-overview.css">
    <?php $navbar_index = "products"; ?>
</head>

<body>
<?php include __DIR__ . '/../layout/navbar.php'; ?>

<main>
    <?php if (isset($c)): ?>
        <h2><?= $c->name ?></h2>
    <?php endif; ?>
    <?php include __DIR__ . '/../layout/searchbar.php'; ?>
    <div class="grid-container">
    <?php
    if (isset($products)):
        if (count($products) > 0):
            for ($p = 0; $p < count($products); $p += 3):
                ?>
                    <?php
                    for ($count = 0; $count < 3; $count++) {
                        if (isset($products[$p + $count])) {
                            $product = $products[$p + $count];
                            include __DIR__ . '/../layout/product.php';
                        }
                    }
                    ?>
            <?php
            endfor; ?>
    </div>
            <?php include __DIR__ . '/../layout/pageNavigation.php'; ?>
        <?php
        else: ?>
            <p class="product-not-found">Es wurden keine Produkte gefunden.</p>
        <?php
        endif;
    endif;
    ?>

</main>
<?php include __DIR__ . '/../layout/footer.php'; ?>
<script src="/assets/js/jquery-3.6.0.min.js"></script>
<script src="/assets/js/products.js"></script>
</body>

</html>
