<a class="grid-column-4 no-text-decoration" href="./show?id=<?=$product->product_ID?>">
    <article>
        <figure style="background-image: url('<?=$product->images[0]->base64?>')"></figure>

        <h4><?=$product->name?></h4>
        <p><?php echo nl2br(htmlspecialchars($product->description))?></p>

        <div class="price">
                <?php if ($product->discount > 0) { ?>
                    <span><?=str_replace('.', ',', $product->discountPriceEuro)?></span>
                    <span><?=str_replace('.', ',', $product->priceEuro)?></span>
                <?php } else { ?>
                    <span><?=str_replace('.', ',', $product->priceEuro)?></span>
                <?php } ?>
            <button>Jetzt Bestellen</button>
        </div>
    </article>
</a>
