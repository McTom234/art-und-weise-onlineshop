<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/shoppingCart.css">
</head>

<body>
<?php require __DIR__ . '/../layout/navbar.php'; ?>
<main>
    <section id="cart-list"><h2>Warenkorb</h2></section>
    <a href="/buy" class="link-button">Kaufen</a>
</main>

<?php require __DIR__ . '/../layout/footer.php'; ?>

<script src="/assets/js/cookies.js"></script>
<script src="/assets/js/shoppingCart.js"></script>
<script src="/assets/js/quantitySelect.js"></script>
<script src="/assets/js/renderShoppingCart.js"></script>
</body>
</html>