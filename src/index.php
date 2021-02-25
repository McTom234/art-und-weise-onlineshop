<?php require 'database/authentication.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
<header>

    <div class="header_image">
        <h3>Schülerfirma</h3>
        <div class="header_title">
            <h1>Art & Weise</h1>
        </div>
        <button class="button_more">Mehr Erfahren!</button>
    </div>

    <nav class="navbar navbar-light navbar-expand-md d-xxl-flex navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="#">Art &amp; Weise</a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span
                        class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Start</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false"
                                                     data-bs-toggle="dropdown" href="#">Dropdown </a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="#">Karten</a><a class="dropdown-item"
                                                                                                  href="#">Lesezeichen</a><a
                                    class="dropdown-item" href="#">Kategorie 3</a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Hintergrund</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Über uns</a></li>
                </ul>
                <span class="nav-left float-end">
                    <a class="link" href="login">Log In</a>
                    <a class="link" href="login">Log Out</a>
                    <button>Warenkorb</button>
                </span>
            </div>
        </div>
    </nav>
    <div class="recommended">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Beliebt</h2>
                <p class="text-center">Eine Auswahl der beliebtesten Produkte</p>
            </div>

            <div class="row">
                <div id="col-left" class="col d-flex justify-content-center">
                    <div class="item">
                        <div class="item_image"></div>
                        <h3 class="item_title">Titel</h3>
                        <p class="item_description">Lorem ipsum dolor sibum. Stet clita kasd gubergren sanctus est Lorem
                            ipsum dolor sit amet.</p>

                        <div class="wrapper d-flex justify-content-between">
                            <h3 class="item_price">3€</h3>
                            <button>Jetzt Bestellen</button>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="item">
                        <div class="item_image"></div>
                        <h3 class="item_title">Titel</h3>
                        <p class="item_description">Lorem ipsum dolor sibum. Stet clita kasd gubergren sanctus est Lorem
                            ipsum dolor sit amet.</p>

                        <div class="wrapper d-flex justify-content-between">
                            <h3 class="item_price">3€</h3>
                            <button>Jetzt Bestellen</button>
                        </div>
                    </div>
                </div>
                <div id="col-right" class="col d-flex justify-content-center">
                    <div class="item">
                        <div class="item_image"></div>
                        <h3 class="item_title">Titel</h3>
                        <p class="item_description">Lorem ipsum dolor sibum. Stet clita kasd gubergren sanctus est Lorem
                            ipsum dolor sit amet.</p>

                        <div class="wrapper d-flex justify-content-between">
                            <h3 class="item_price">3€</h3>
                            <button>Jetzt Bestellen</button>
                        </div>
                    </div>


                </div>
            </div>

            <button class="float-end">Weitere</button>

        </div>
    </div>

    <div class="recommended">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Beliebt</h2>
                <p class="text-center">Eine Auswahl der beliebtesten Produkte</p>
            </div>

            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="item">
                        <div class="item_image"></div>
                        <h3 class="item_title">Titel</h3>
                        <p class="item_description">Lorem ipsum dolor sibum. Stet clita kasd gubergren sanctus est Lorem
                            ipsum dolor sit amet.</p>

                        <div class="wrapper d-flex justify-content-between">
                            <h3 class="item_price">3€</h3>
                            <button>Jetzt Bestellen</button>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="item">
                        <div class="item_image"></div>
                        <h3 class="item_title">Titel</h3>
                        <p class="item_description">Lorem ipsum dolor sibum. Stet clita kasd gubergren sanctus est Lorem
                            ipsum dolor sit amet.</p>

                        <div class="wrapper d-flex justify-content-between">
                            <h3 class="item_price">3€</h3>
                            <button>Jetzt Bestellen</button>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="item">
                        <div class="item_image"></div>
                        <h3 class="item_title">Titel</h3>
                        <p class="item_description">Lorem ipsum dolor sibum. Stet clita kasd gubergren sanctus est Lorem
                            ipsum dolor sit amet.</p>

                        <div class="wrapper d-flex justify-content-between">
                            <h3 class="item_price">3€</h3>
                            <button>Jetzt Bestellen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <hr>
        <div class="container">
            <div class="row">
                <div class="col"> </div>
                <div class="col"><span class="float-end copyright">Schülerfirma Art & Weise &copy; 2021</span></div>
            </div>
        </div>
    </div>

</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/index.js"></script>
</html>