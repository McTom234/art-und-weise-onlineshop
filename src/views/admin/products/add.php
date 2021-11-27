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
    <div>
        <form enctype="multipart/form-data" method="post">
            <?php require __DIR__ . '/../../layout/imagePicker.php'; ?>
            <label>
                Name
                <input required type="text" name="name"/>
            </label>
            <label>
                Beschreibung
                <textarea name="description"></textarea>
            </label>
            <label>
                Preis (5 = 5 Cent; 50 = 50 Cent)
                <input required type="number" name="price_euro" min="0">
                <input required type="number" name="price_cent" value="0" min="0" max="99">
            </label>
            <label>
                Rabatt
                <input required type="number" name="discount" min="0" max="100"
                       step="1">
            </label>

            <label>
                Kategorie
                <select name="category">
                    <option value="">Keine</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->category_ID ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <button type="submit">Hinzufügen</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../../layout/footer.php'; ?>

</body>
</html>
