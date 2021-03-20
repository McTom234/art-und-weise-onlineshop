<?php
$pdo = require '../database/connect.php';
require '../database/authentication.php'
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="../css/home.css">
</head>

<body>

<div class="container">


    <?php require '../components/navbar.php'; ?>

    <?php
    if (isset($_GET['id'])) {

        $id = htmlspecialchars($_GET['id']);
        $statement = $pdo->prepare('SELECT * FROM product WHERE product_ID = :id');
        $statement->execute(array('id' => $id));
        $product = $statement->fetch();

        if ($product) {
            ?>

            <div class="product_view">
                <h1><?php echo $product['name']; ?></h1>
                <p><?php echo $product['description']; ?></p>
                <button onclick="addToBasket(<?php echo $product['product_ID'];?>)">+ Warenkorb</button>
            </div>

        <?php } else { ?>
            <h1>Produkt konnte nicht gefunden werden!</h1>
        <?php }
    } else { ?>
        <h1>Produkt konnte nicht gefunden werden.</h1>
    <?php } ?>

</div>

<?php require '../components/footer.php'; ?>

</body>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/index.js"></script>
</html>