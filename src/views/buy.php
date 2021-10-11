<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/buy.css">
</head>

<body>
<?php include __DIR__ . '/layout/navbar.php'; ?>
<main>
    <h2>Überprüfen der Bestellung</h2>
    <div class="grid-container">
        <section class="grid-column--6">
            <h3>Deine Produkte</h3>
            <table>
                <thead>
                    <tr>
                        <th>Bezeichnung</th>
                        <th>Stückzahl</th>
                        <th>Einzelpreis</th>
                        <th>Gesamtpreis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shoppingCart as $product): ?>
                    <tr>
                        <td><?=$product->name?></td>
                        <td><?=$product->price?> €</td>
                        <td><?=$product->count?></td>
                        <td><?=str_replace(".", ",", round($product->price * $product->count, 2))?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?=$totalPrice?> €</td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="grid-column--6">
            <h3>Deine Daten</h3>
            <ul>
                <li>Name: <?= $loggedIn->forename . ' ' . $loggedIn->surname ?></li>
                <li>Email: <?= $loggedIn->email ?></li>
                <li><?= $userLocation->street . ' ' . $userLocation->street_number?> <br>
                    <?= $userLocation->postcode . ' ' . $userLocation->city?>
                </li>
            </ul>
        </section>
    </div>

    <a class="link-button" href="?submit=1">Bestellen</a>

</main>

<?php include __DIR__ . '/layout/footer.php'; ?>

</body>
</html>