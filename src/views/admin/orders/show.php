<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <?php $navbar_index = "orders"; ?>
</head>
<body>
<?php require __DIR__ . '/../../layout/navbarAdmin.php'; ?>
<div>
    <h3>Bestellung</h3>
    <table>
        <tr>
            <td><?= $checkout->forename ?> <?= $checkout->surname ?></td>
        </tr>
        <tr>
            <?php $location = $checkout->street . " " . $checkout->street_number . ", " . $checkout->postcode . " " . $checkout->city; ?>
            <td><a href="https://www.google.com/maps/search/?api=1&query=<?= $location ?>"><?= $location ?></a></td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Produkt</th>
            <th>Rabbat</th>
            <th>Anzahl</th>
        </tr>
        <?php foreach ($checkout->orders as $order): ?>
            <tr>
                <td><a href="/show?id=<?= $order->product_ID; ?>"><?= $order->product_name; ?></a></td>
                <td><?= $order->discount != 100 ? 100-$order->discount."%" : "Kein Rabatt"; ?></td>
                <td><?= $order->quantity ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require __DIR__ . '/../../../views/layout/footer.php'; ?>
</body>
</html>