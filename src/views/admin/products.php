<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <?php $navbar_index = "products"; ?>
</head>
<body>
<?php require __DIR__ . '/../layout/navbarAdmin.php'; ?>
<div>
    <h3 class="card-title">Produkte</h3>
    <a href="/admin/products/add" class="link-button">Produkt hinzufügen</a>
    <?php require __DIR__ . '/../layout/searchbar.php'; ?>
    <table>
        <thead>
        <tr>
            <th>Produkt ID</th>
            <th>Name</th>
            <th>Preis</th>
            <th>Rabatt</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td>
                    <?= $product->product_ID; ?>
                </td>
                <td>
                    <?= $product->name; ?>
                </td>
                <td>
                    <?= $product->price; ?>
                    €
                </td>
                <td>

                    <?php if ($product->discount == 100): ?>
                        kein Rabatt
                    <?php else: ?>
                        <?= 100-$product->discount; ?>%
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/admin/products/edit?id=<?=$product->product_ID?>" class="link-button">Bearbeiten</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php require __DIR__ . '/../../views/layout/pageNavigation.php'; ?>

</div>
<?php require __DIR__ . '/../../views/layout/footer.php'; ?>
</body>
</html>