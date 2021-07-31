<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/showProduct.css">
</head>

<body>

<div id="popup" class="hide">
    <div id="popup-box">
        <div onclick="closePopup()" id="cancel">×</div>
        <p><strong><?= $product->name ?></strong> wurde zum Warenkorb hinzugefügt</p>
        <p id="count">Anzahl: 1</p>
        <p id="popup-price"></p>
        <a href="./shopping-cart">
            <button>Zum Warenkorb</button>
        </a>
    </div>
</div>


<?php include __DIR__ . '/../layout/navbar.php'; ?>
<div class="container content">

    <?php if ($product) { ?>

        <div class="product_view">
            <div class="images-wrapper">
                <img src="data:image/png;base64,<?= $product->images[0]->base64 ?>" class="item_image"
                     alt="Image: <?= $product->name ?>"/>
            </div>
            <div class="text-wrapper">
                <h1><?= $product->name; ?></h1>
                <p><?= $product->description; ?></p>
                <?php if ($product->discount > 0) { ?>
                    <span><?=str_replace('.', ',', $product->discountPriceEuro)?> </span><span style='text-decoration: line-through'><?=str_replace('.', ',', $product->priceEuro)?> €</span>
                <?php } else { ?>
                    <span><?=str_replace('.', ',', $product->priceEuro)?> €</span>
                <?php } ?>
            </div>
            <div class="panel-wrapper">
                <div class="panel-box">
                    <button id="addToCartButton">In den Einkaufswagen</button>
                    <button id="buyButton">Jetzt kaufen</button>
                    <div id="quantitySelect-wrapper"></div>
                    <div id="price"><?=$product->discountPriceEuro?> €
                    </div>
                </div>
            </div>
        </div>

    <?php } else { ?>
        <h1>Produkt konnte nicht gefunden werden!</h1>
    <?php } ?>


</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

</body>
<script src="/assets/js/cookies.js"></script>
<script src="/assets/js/shoppingCart.js"></script>
<script src="/assets/js/quantitySelect.js"></script>
<script>


    const values = [
        1, 2, 3, 4, 5
    ]


    let currentValue = 1;
    let quantitySelect = createQuantitySelect(currentValue, values, 100, true, function (number) {
        let price = document.getElementById('price');
        price.textContent = <?=$product->discountPriceEuro?> * number + "€";
        currentValue = number;
    });


    let quantitySelectWrapper = document.getElementById("quantitySelect-wrapper");
    quantitySelectWrapper.append(quantitySelect);


    let popup = document.getElementById("popup");
    popup.addEventListener("click", function (event) {
        if (event.target === popup) {
            closePopup();
        }
    });

    let addToCartButton = document.getElementById('addToCartButton');
    addToCartButton.addEventListener('click', function () {
        addItem(<?=$product->product_ID?>, currentValue)
        openPopup();
    });

    function openPopup() {
        let count = document.getElementById('count');
        count.textContent = "Anzahl: " + currentValue;
        let price = document.getElementById('popup-price');
        price.textContent = <?=$product->discountPriceEuro?> * currentValue + "€";
        popup.className = "";






    }

    function closePopup() {
        popup.className = "hide";
    }

    let buyButton = document.getElementById('buyButton');
    buyButton.addEventListener('click', function () {
        console.log('buy');
    });

</script>
</html>