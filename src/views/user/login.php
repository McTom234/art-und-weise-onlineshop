<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise | Login</title>
    <link rel="stylesheet" href="/assets/css/user-forms.css"/>
<?php
        $loggedIn = false;
        $navbar_index = "login";
?>
</head>

<body>
    <?php require __DIR__ . '/../layout/navbar.php'; ?>

    <main>
        <form id="menu" action="?login=1<?php if($buy) echo'&buy=1'?>" method="post">
            <h2>Anmeldung</h2>

            <input id="email" type="email" name="email" placeholder=" "/>
            <label for="email">E-Mail</label>

            <input id="password" type="password" name="password" placeholder=" "/>
            <label for="password">Passwort</label>

            <button type="submit">Anmelden</button>

            <a class="link-button" href="/registration">Registrieren</a>

            <?php if (isset($message)) { ?>
                <p class="error">
                    <?=$message?>
                </p>
            <?php } ?>
        </form>
    </main>

    <?php require __DIR__ . '/../layout/footer.php'; ?>
</body>

</html>