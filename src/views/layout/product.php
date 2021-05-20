<a href="./show?id=<?=$product->product_ID?>">
    <div class="item">
        <img src="data:image/png;base64,<?=$product->images[0]->base64?>" class="item_image" alt="Image: <?=$product->name?>" />

        <h3 class="item_title"><?=$product->name?></h3>
        <p class="item_description"><?php echo nl2br(htmlspecialchars($product->shortDescription))?></p>

        <div class="wrapper d-flex justify-content-between">
            <h3 class="item_price">
                <?php if ($product->discount > 0) { ?>
                    <span><?=str_replace('.', ',', $product->discountPriceEuro)?> </span><span style='text-decoration: line-through'><?=str_replace('.', ',', $product->priceEuro)?> €</span>
                <?php } else { ?>
                    <span><?=str_replace('.', ',', $product->priceEuro)?> €</span>
                <?php } ?>
            </h3>
            <button>Jetzt Bestellen</button>
        </div>
    </div>
</a>
