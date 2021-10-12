<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise | <?= $product->name ?></title>
    <link rel="stylesheet" href="/assets/css/showProduct.css">
    <!-- TODO: add navbar tag -->
    <?php $navbar_index = "login"; ?>
</head>

<body>
    <div id="popup" class="hide popup">
        <div class="popup-box">
            <div onclick="closePopup()" class="popup-cancel">×</div>

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
                <figure>
                    <img src="<?= $product->images[0]->base64 ?>" class="item_image" alt="Image: <?= $product->name ?>"/>
                </figure>

                <div>
                    <h4><?= $product->name; ?></h4>

                    <p><?= $product->description; ?></p>
                </div>

                <aside>
                    <?php if ($product->discount > 0) { ?>
                        <span><?=str_replace('.', ',', $product->discountPriceEuro)?></span>

                        <span style='text-decoration: line-through'><?=str_replace('.', ',', $product->priceEuro)?></span>
<?php
                    }
                    else {
?>
                        <span><?=str_replace('.', ',', $product->priceEuro)?></span>
                    <?php } ?>

                    <button id="addToCartButton">In den Einkaufswagen</button>

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
        const values = [
            1, 2, 3, 4, 5
        ]


        let currentValue = 1;
        let quantitySelect = createQuantitySelect(currentValue, values, 100, true, function (number) {
            let price = document.getElementById('price');
            price.textContent = (<?=$product->discountPriceEuro?> * number).toFixed(2).toString().replace(".",",");
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
            popup.classList.remove("hide");
        }

        function closePopup() {
            popup.classList.add("hide");
        }

        let buyButton = document.getElementById('buyButton');
        buyButton.addEventListener('click', function () {
            console.log('buy');
        });
    </script>
</body>

</html>