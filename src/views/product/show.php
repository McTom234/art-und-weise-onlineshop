<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
</head>

<body>

<div id="popup-box">
    <a href="#" class="cancel">×</a>
    <p><strong><?=$product->name?></strong> wurde zum Warenkorb hinzugefügt</p>
    <a href="./shopping-cart"><button>Zum Warenkorb</button></a>
</div>
<div id="popup">

</div>

<?php include __DIR__ . '/../layout/navbar.php'; ?>
<div class="container content">

    <?php if ($product) {?>

            <div class="product_view">
                <h1><?php echo $product->name; ?></h1>
                <p><?php echo $product->description; ?></p>
                <a href="#popup-box"><button onclick="addItem(<?=$product->product_ID?>)">+ Warenkorb</button></a>
            </div>

    <?php } else { ?>
        <h1>Produkt konnte nicht gefunden werden!</h1>
    <?php } ?>



</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

</body>
<script src="../../assets/js/shoppingCart.js"></script>
</html>