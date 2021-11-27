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
    <?php $navbar_index = "products"; ?>
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
                <label>
                    Name
                    <input required type="text" name="name" value="<?= $product->name; ?>"/>
                </label>
                <label>
                    Beschreibung
                    <textarea name="description"><?= $product->description; ?></textarea>
                </label>
                <label>
                    Preis (5 = 5 Cent; 50 = 50 Cent)
                    <input required type="number" name="price_euro" value="<?= intdiv($product->price,100); ?>" min="0">
                    <input required type="number" name="price_cent" value="<?= $product->price-(intdiv($product->price,100)*100); ?>" min="0" max="99">
                </label>
                <label>
                    Rabatt
                    <input required type="number" name="discount" value="<?= 100-$product->discount; ?>" min="0" max="100"
                           step="1">
                </label>

                <label>
                    Kategorie
                    <select  name="category">
                        <option value="">Keine</option>
                        <?php foreach ($categories as $category):?>
                            <option value="<?=$category->category_ID?>" <?php if($category->selected) echo "selected";?>><?=$category->name?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

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
</html>
