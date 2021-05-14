<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
    <?php require '../views/layout/navbar.php';?>
    <div class="grid-container">
        <div class="grid-column-8 grid-column">
            <h3 class="card-title">Bestellungen</h3>
            <div class="card-bottom">
                <a href=""><button>Gehe zur Übersicht</button></a>
            </div>
        </div>
        <div class="grid-column-4 grid-column">
            <h3 class="card-title">Mitglieder</h3>
            <div>

            </div>
            <div class="card-bottom">
                <a href=""><button>Gehe zur Übersicht</button></a>
            </div>
        </div>
        <div class="grid-column-6 grid-column">
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
                <?php
                    foreach ($products as $product) {
                        echo '<tr><td>';
                        echo $product->name;
                        echo '</td><td>';
                        echo $product->price;
                        echo '€</td><td>';
                        echo $product->discountPercent;
                        if (empty($product->discountPercent)) {
                            echo 'kein Rabatt';
                        }
                        echo '</td><td>';
                        echo '<a href=""><button>Bearbeiten</button></a>';
                        echo '</td></tr>';
                    }
                ?>
                </tbody>
            </table>
            <div class="card-bottom">
                <a href=""><button>Gehe zur Übersicht</button></a>
            </div>
        </div>
        <div class="grid-column-6 grid-column">
            <h3 class="card-title">Finzanzen</h3>
            <div class="card-bottom">
                <a href=""><button>Gehe zur Übersicht</button></a>
            </div>
        </div>
        <div class="grid-column-8 grid-column">
            <h3 class="card-title">News</h3>
            <div class="card-bottom">
                <a href=""><button>Gehe zur Übersicht</button></a>
            </div>
        </div>
        <div class="grid-column-4 grid-column">
            <h3 class="card-title">Bilder</h3>
            <div class="card-bottom">
                <a href=""><button>Gehe zur Übersicht</button></a>
            </div>
        </div>
    </div>
    <?php require '../views/layout/footer.php'; ?>
</body>
</html>