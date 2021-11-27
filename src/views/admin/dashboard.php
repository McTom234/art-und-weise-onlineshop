<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/admin/dashboard.css">
    <?php $navbar_index = "home"; ?>
</head>
<body>
<?php require __DIR__ .'/../layout/navbarAdmin.php'; ?>
<main>
    <h2>Administrator-Dashboard</h2>
    <div class="grid-container">
        <div class="grid-column--8 grid-column">
            <h3 class="card-title">Bestellungen</h3>
            <table>
                <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Rabatt</th>
                    <th>Anzahl</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?=$order->product_name; ?></td>
                        <td><?= $order->discount != 100 ? 100-$order->discount."%" : "Kein Rabatt"; ?></td>
                        <td><?= $order->quantity; ?></td>
                        <td><a href="/show?id=<?=$order->product_ID; ?>" class="link-button">Ansehen</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="card-bottom">
                <a href="/admin/orders" class="link-button">Gehe zur Übersicht</a>
            </div>
        </div>
        <div class="grid-column--4 grid-column">
            <!--<h3 class="card-title">Mitglieder</h3>
            <div>

            </div>
            <div class="card-bottom">
                <a href="" class="link-button">Gehe zur Übersicht</a>
            </div>-->
        </div>
        <div class="grid-column--6 grid-column">
            <h3 class="card-title">Produkte</h3>
            <table>
                <thead>
                <tr>
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
                            <?= $product->name; ?>
                        </td>
                        <td>
                            <?= str_replace(".", ",", $product->price/100); ?>
                            €
                        </td>
                        <td><?= $product->discount != 100 ? 100-$product->discount."%" : "Kein Rabatt"; ?></td></td>
                        <td>
                            <a href="/admin/products/edit?id=<?=$product->product_ID ?>" class="link-button">Bearbeiten</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="card-bottom">
                <a href="/admin/products" class="link-button">Gehe zur Übersicht</a>
            </div>
        </div>
        <div class="grid-column--6 grid-column">
            <!--<h3 class="card-title">Finzanzen</h3>
            <div class="card-bottom">
                <a href="" class="link-button">Gehe zur Übersicht</a>
            </div>-->
        </div>
        <!--<div class="grid-column--8 grid-column">
            <h3 class="card-title">News</h3>
            <div class="card-bottom">
                <a href="">
                    <button>Gehe zur Übersicht</button>
                </a>
            </div>
        </div>
        <div class="grid-column--4 grid-column">
            <h3 class="card-title">Bilder</h3>
            <div class="card-bottom">
                <a href="">
                    <button>Gehe zur Übersicht</button>
                </a>
            </div>
        </div>-->
    </div>
</main>
<?php require '../views/layout/footer.php'; ?>
</body>
</html>