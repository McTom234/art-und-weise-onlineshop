<a href="./show?id=<?=$product->product_ID?>">
    <div class="item">
        <img src="data:image/png;base64,<?=$product->images[0]->base64?>" class="item_image" alt="Image: <?=$product->name?>" />

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
