<article class="grid-column--4">
    <?php if (count($product->images)>0) { ?>
        <a class="no-text-decoration" href="./show?id=<?=$product->product_ID?>">
            <figure style="background-image: url('<?=$product->images[0]->base64?>')"></figure>
        </a>
    <?php } ?>

    <h4>
        <a class="no-text-decoration" href="./show?id=<?=$product->product_ID?>"><?=$product->name?></a>
    </h4>

    <p>
        <a class="no-text-decoration" href="./show?id=<?=$product->product_ID?>"><?php echo nl2br(htmlspecialchars($product->description))?></a>
    </p>

    <div class="price">
        <?php if ($product->discount > 0) { ?>
            <span><?=str_replace('.', ',', $product->discountPriceEuro)?></span>

            <span><?=str_replace('.', ',', $product->priceEuro)?></span>
<?php
        }
        else {
?>
            <span><?=str_replace('.', ',', $product->priceEuro)?></span>
        <?php } ?>

        <a href="./show?id=<?=$product->product_ID?>" class="link-button">Jetzt Bestellen</a>
    </div>
</article>
