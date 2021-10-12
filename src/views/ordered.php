<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <?php $navbar_index = "shopping-cart"; ?>
</head>

<body>
    <?php include __DIR__ . '/layout/navbar.php'; ?>

    <main>
        <h2>Danke für Ihre Bestellung!</h2>

        <!-- TODO Email-->

        <p>Wir bearbeiten Ihre Bestellung und werden uns in Kürze bei Ihnen per E-Mail melden.<br/>
            Sollten Sie weitere Fragen zum Bestellvorgang haben, können Sie uns per <a href="mailto:jonas">E-Mail</a> erreichen.</p>

        <a href="/" class="link-button">Zur Startseite</a> <a href="/about" class="link-button">Mehr über uns</a>
    </main>

    <?php include __DIR__ . '/layout/footer.php'; ?>
</body>

</html>