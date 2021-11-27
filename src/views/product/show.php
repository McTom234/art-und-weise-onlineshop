<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise | <?= $product->name ?></title>
    <link rel="stylesheet" href="/assets/css/showProduct.css">
    <?php $navbar_index = $c->name ?? "products"; ?>
</head>

<body>
    <div id="popup" class="popup">
        <a href="#" class="popup"></a>
        <div class="popup-box">
            <a class="popup-cancel no-text-decoration" href="#">×</a>

            <div class="popup-title"><strong><?= $product->name ?></strong> wurde zum Warenkorb hinzugefügt</div>

            <div class="popup-content">
                <p>Preis: <span id="popup-price"></span> €</p>

                <p>Anzahl: <span id="popup-count"></span></p>

                <p>Gesamt: <span id="popup-result"></span> €</p>
            </div>

            <div class="popup-bottom">
                <a href="./shopping-cart" class="link-button">Zum Warenkorb</a>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <main>
        <?php if ($product) { ?>
            <article>
                <?php if (count($product->images)>0) { ?>
                    <figure>
                        <img src="<?= $product->images[0]->base64 ?>" class="item_image" alt="Image: <?= $product->name ?>"/>
                    </figure>

                    <div>
                <?php } else { ?>
                    <div class="no-figure">
                <?php } ?>

                    <h4><?= $product->name; ?></h4>

                    <?php if ($c): ?>
                        <p><a href="/products?c=<?=$c->category_ID?>"><?=$c->name?></a></p>
                    <?php endif; ?>

                    <p><?= $product->description; ?></p>
                </div>

                <aside>
                    <?php if ($product->discount != 100) { ?>
                        <span><?=str_replace('.', ',', $product->discountPriceEuro)?></span>

                        <span><?=str_replace('.', ',', $product->priceEuro)?></span>
<?php
                    }
                    else {
?>                     <span style="grid-column: 2;"><?=str_replace('.', ',', $product->priceEuro)?></span>
                    <?php } ?>

                    <a href="#popup" id="addToCartButton" class="link-button">In den Einkaufswagen</a>

                    <button class="inactive" id="buyButton">Jetzt kaufen</button>

                    <div id="quantitySelect-wrapper"></div>

                    <p id="price"><?= str_replace(".", ",", round($product->discountPriceEuro, 2)) ?></p>
                </aside>
            </article>
<?php
        }

        else {
?>
            <p class="product-not-found">Produkt konnte nicht gefunden werden!</p>
        <?php } ?>
    </main>

    <?php include __DIR__ . '/../layout/footer.php'; ?>

    <script src="/assets/js/cookies.js"></script>
    <script src="/assets/js/shoppingCart.js"></script>
    <script src="/assets/js/quantitySelect.js"></script>
    <script>
        const url = window.location.href.split('#');
        while (url.length >= 2 && url[url.length-1] !== "") {
            url.pop();
            window.location.href = url.join();
        }

        const values = [
            1, 2, 3, 4, 5
        ]
        let currentValue = 1;
        document.getElementById('quantitySelect-wrapper').appendChild(
            createQuantitySelect(currentValue, values, 100, true, function (number) {
                let price = document.getElementById('price');
                price.textContent = (<?=$product->discountPriceEuro?> * number).toFixed(2).toString().replace(".",",");
                currentValue = number;
            })
        );

        document.getElementById('addToCartButton').addEventListener('click', function () {
            addItem("<?=$product->product_ID?>", currentValue)
            openPopup();
        });

        function openPopup() {
            let count = document.getElementById('popup-count');
            count.textContent = currentValue.toString().replace(".",",");
            let price = document.getElementById('popup-price');
            price.textContent = <?=$product->discountPriceEuro?>;
            let result = document.getElementById('popup-result');
            result.textContent = (currentValue * <?=$product->discountPriceEuro?>).toFixed(2).toString().replace(".",",");
        }

        let buyButton = document.getElementById('buyButton');
        buyButton.addEventListener('click', function () {
            console.log('buy');
        });
    </script>
</body>

</html>