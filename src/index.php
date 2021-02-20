<?php require 'database/authentication.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="../dist/css/index.css">
</head>

<body>
    <header>

    <div id="header_image">
        <h3>Schülerfirma</h3>
        <h1>Art & Weise</h1>
        <button class="button_more">Mehr Erfahren!</button>
    </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">

                <a class="navbar-brand">Art & Weise</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse bg-dark" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link">Start</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Produkte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Hintergrund</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Jetzt Bestellen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Über uns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login/">Login</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>

    <div class="navbar_placeholder"></div>

    <div class="recommended">
        <div class="item">
            <div class="item_image"></div>
            <h3 class="item_title">Titel</h3>
            <p class="item_description">Lorem ipsum dolor sibum. Stet clita kasd gubergren sanctus est Lorem ipsum dolor sit amet.</p>

            <div class="wrapper">
                <h3 class="item_price">3€</h3>
                <button>Jetzt Bestellen</button>
            </div>
        </div>

</body>
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/bootstrap.bundle.min.js"></script>
<script src="js/index.js"></script>
</html>