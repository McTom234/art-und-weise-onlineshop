<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/shoppingCart.css">
</head>

<body>
<?php require __DIR__ . '/../layout/navbar.php'; ?>
<div class="container content">


    <h1>Warenkorb</h1>
    <div id="cart-list"></div>

    <a href="/buy">
        <button>Kaufen</button>
    </a>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>

</body>
<script src="/assets/js/cookies.js"></script>
<script src="/assets/js/shoppingCart.js"></script>
<script src="/assets/js/quantitySelect.js"></script>
<script src="/assets/js/renderShoppingCart.js"></script>
</html>