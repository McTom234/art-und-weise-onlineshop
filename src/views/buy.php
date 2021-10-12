<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Schülerfirma Art und Weise | Bestellung</title>
    <link rel="stylesheet" href="/assets/css/buy.css">
    <?php $navbar_index = "shopping-cart"; ?>
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
                                <td><?=str_replace(".", ",", $product->price)?> €</td>
                                <td><?=$product->count?></td>
                                <td><?=str_replace(".", ",", sprintf('%.2f', $product->price * $product->count))?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?=str_replace(".", ",", $totalPrice)?> €</td>
                        </tr>
                    </tfoot>
                </table>
            </section>

            <section class="grid-column--6">
                <h3>Deine Daten</h3>

                <table>
                    <tbody>

                    <tr>
                        <td>Name</td>
                        <td><?= $loggedIn->forename . ' ' . $loggedIn->surname ?></td>
                    </tr>

                    <tr>
                        <td>E-Mail</td>
                        <td><?= $loggedIn->email ?></td>
                    </tr>

                    <tr>
                        <td>Adresse</td>
                        <td><?= $userLocation->street . ' ' . $userLocation->street_number?><br>
                            <?= $userLocation->postcode . ' ' . $userLocation->city?></td>
                    </tr>

                    </tbody>
                </table>
            </section>
        </div>

        <a class="link-button" href="?submit=1">Bestellen</a>
    </main>

    <?php include __DIR__ . '/layout/footer.php'; ?>
</body>

</html>