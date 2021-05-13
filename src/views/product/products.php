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
<?php include __DIR__ . '/../layout/navbar.php'; ?>
<div class="container">




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

<?php include __DIR__ . '/../layout/footer.php'; ?>

</body>
</html>
