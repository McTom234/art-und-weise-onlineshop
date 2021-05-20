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
<div class="container content">

    <form>
        <label>
            <input type="text" name="q">
        </label>
        <button type="submit">Suchen!</button>
    </form>



    <?php
    if(isset($products)){
        for($p = 0; $p < count($products); $p+=3){?>
            <div class="items_wrapper">
                <?php
                for($count = 0; $count < 3; $count++) {
                    if(isset($products[$p + $count])){
                        $product = $products[$p + $count];
                        include __DIR__ . '/../layout/product.php';
                    }
                }?>
            </div>
    <?php }}?>

    <?php

    $lastPageLink = '';
    $nextPageLink = '';
    if(isset($request['page'])){
        $page = $request['page'];
        if($page > 1){
            $lastPageLink .= '?p=' . ($page - 1);
            $nextPageLink .= '?p=' . ($page + 1);
            if(isset($request['query'])) {
                $nextPageLink .= '&q=' . $request['query'];
                $lastPageLink .= '&q=' . $request['query'];
            }
        }else{
            $nextPageLink .= '?p=' . ($page + 1);
            if(isset($request['query'])) $nextPageLink .= '&q=' . $request['query'];
        } ?>
            <a href="<?=$lastPageLink?>"><</a>
            <span>Seite <?=$page?> von <?=$maxPages?></span>
            <a href="<?=$nextPageLink?>">></a>
    <?php } ?>





</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

</body>
<script src="/assets/js/jquery-3.6.0.min.js"></script>
<script src="/assets/js/products.js"></script>
</html>
