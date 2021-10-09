<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
</head>

<body>
<?php require __DIR__ . '/../../layout/navbarAdmin.php'; ?>
<main>

    <?php if ($product) { ?>
        <div>
            <form enctype="multipart/form-data" method="post">
                <?php if (isset($product->images[0])): ?>
                    <?php $src = $product->images[0]->base64 ?>
                <?php endif; ?>
                <?php require __DIR__ . '/../../layout/imagePicker.php'; ?>
                <input required type="text" name="name" value="<?= $product->name; ?>"/>
                <textarea name="description"><?= $product->description; ?></textarea>
                <input required type="number" name="price" value="<?= $product->price; ?>" min="0">
                <input required type="number" name="discount" value="<?= $product->discount; ?>" min="0" max="100"
                       step="1">
                <button type="submit">Speichern</button>
            </form>

            <form method="post">
                <button name="delete" type="submit">Löschen</button>
            </form>
        </div>
    <?php } else { ?>
        <p class="product-not-found">Produkt konnte nicht gefunden werden!</p>
    <?php } ?>


</main>

<?php include __DIR__ . '/../../layout/footer.php'; ?>

</body>
<script src="/assets/js/cookies.js"></script>
<script src="/assets/js/shoppingCart.js"></script>
<script src="/assets/js/quantitySelect.js"></script>
</html>
