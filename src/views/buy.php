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
<?php include __DIR__ . '/layout/navbar.php'; ?>
<div class="container content">

    <h1>Deine Produkte</h1>
    <ul>
        <?php foreach ($shoppingCart as $product): ?>

        <li><?=$product->name?>
            <ul>
                <li>Anzahl: <?=$product->count?></li>
                <li>Preis: <?=$product->price?>€</li>
            </ul>
        </li>
        <?php endforeach; ?>
    </ul>
    <span>Gesamtpreis: <?=$totalPrice?>€</span>

    <h1>Deine Daten</h1>
    <ul>
        <li>Name: <?= $loggedIn->forename . ' ' . $loggedIn->surname ?></li>
        <li>Email: <?= $loggedIn->email ?></li>
        <li><?= $userLocation->street . ' ' . $userLocation->street_number?> <br>
            <?= $userLocation->postcode . ' ' . $userLocation->city?>
        </li>
    </ul>

    <form method="post" action="?submit=1">
        <button type="submit">Bestellen</button>
    </form>

</div>

<?php include __DIR__ . '/layout/footer.php'; ?>

</body>
</html>