<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/user-forms.css"/>
</head>
<body>

<?php
$loggedIn = false;
$navbar_index = "registration";
require __DIR__ . '/../layout/navbar.php';
?>

<main>
    <form id="menu" action="?register=1" method="post">
        <h2>Registrierung</h2>
        <?php if (isset($infoMessage)): ?>
            <p class="info">
                <?=$infoMessage?>
            </p>
        <?php endif; ?>
        <fieldset>
            <div>
                <input id="forename" type="text" class="form_input" name="forename" placeholder=" "/>
                <label for="forename">Vorname</label>
            </div>
            <div>
                <input id="surname" type="text" class="form_input" name="surname" placeholder=" "/>
                <label for="surname">Nachname</label>
            </div>
        </fieldset>
        <fieldset>
            <div>
                <input id="street" type="text" class="form_input" name="street" placeholder=" "/>
                <label for="street">Straße</label>
            </div>
            <div>
                <input id="number" type="text" class="form_input" name="number" placeholder=" "/>
                <label for="number">Nummer</label>
            </div>
            <div>
                <input id="postcode" type="text" class="form_input" name="postcode" placeholder=" "/>
                <label for="postcode">PLZ</label>
            </div>
            <div>
                <input id="city" type="text" class="form_input" name="city" placeholder=" "/>
                <label for="city">Stadt</label>
            </div>
        </fieldset>
        <input id="email" type="email" class="form_input" name="email" placeholder=" "/>
        <label for="email">E-Mail</label>
        <input id="password" type="password" class="form_input" name="password" placeholder=" "/>
        <label for="password">Passwort</label>
        <input id="password2" type="password" class="form_input" name="password2" placeholder=" "/>
        <label for="password2">Passwort wiederholen</label>

        <button type="submit">Registrieren</button>
        <a class="link-button" href="/login">Zum Log In wechseln</a>
        <?php if (isset($errorMessage)): ?>
            <p class="error">
                <?= $errorMessage ?>
            </p>
        <?php endif; ?>

    </form>
</main>

<?php require __DIR__ . '/../layout/footer.php'; ?>

</body>
</html>