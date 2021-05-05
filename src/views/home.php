<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/src/assets/css/home.css">
</head>

<body>
<header>
    <div class="header_image">
        <h3>Schülerfirma</h3>
        <div class="header_title">
            <h1>Art & Weise</h1>
        </div>
        <button class="button_more">Mehr Erfahren!</button>
    </div>
</header>

<?php require '../views/layout/navbar.php';?>

<div class="recommended">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Beliebt</h2>
            <p class="text-center">Eine Auswahl der beliebtesten Produkte</p>
        </div>

        <div class="items_wrapper">

            <?php foreach ($products as $product):?>

                <a href="./show?id=<?=$product->product_ID?>">
                    <div class="item">
                        <div class="item_image"></div>
                        <h3 class="item_title"><?=$product->name?></h3>
                        <p class="item_description"><?php echo nl2br(htmlspecialchars($product->shortDescription))?></p>

                        <div class="wrapper d-flex justify-content-between">
                            <h3 class="item_price">
                                <?php if ($product->discount > 0) {
                                    echo $product->price - $product->price * ($product->discount/100) . '€ ' . "<span style='text-decoration: line-through'>" . $product->price . '€</span>';
                                } else {
                                    echo $product->price . '€';

                                } ?>
                            </h3>
                            <button>Jetzt Bestellen</button>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>

        </div>

        <button class="more_items_button">Weitere</button>
    </div>
</div>

<?php require '../views/layout/footer.php';?>

</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="../assets/jsndex.js"></script>
</html>