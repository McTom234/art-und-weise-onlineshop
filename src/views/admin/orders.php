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
<?php require __DIR__ . '/../layout/navbarAdmin.php'; ?>
<div>
    <h3 class="card-title">Bestellungen</h3>
    <?php require __DIR__ . '/../layout/searchbar.php'; ?>
    <table>
        <thead>
        <tr>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Email</th>
            <th>Addresse</th>
            <th>Anzahl der Produkte</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($checkouts as $checkout): ?>
            <tr>
                <td>
                    <?= $checkout->forename; ?>
                </td>
                <td>
                    <?= $checkout->surname; ?>
                </td>
                <td>
                    <?= $checkout->email; ?>
                </td>
                <td>
                    <?= $checkout->street . " " . $checkout->street_number . ", " . $checkout->postcode . " " . $checkout->city ?>
                </td>
                <td>
                    <?= count($checkout->orders);?>
                </td>
                <td>
                    <a href="/admin/orders/show?id=<?=$checkout->checkout_ID?>" class="link-button">Öffnen</button></a>
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