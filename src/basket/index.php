<?php
$pdo = require '../database/connect.php';

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
    if (isset($_POST['basket'])) {

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