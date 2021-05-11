<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/forms.css" />
</head>
<body>
<div class="page_form">
    <form id="menu" action="?register=1" method="post">
        <h1>Registrierung</h1>
        <label>
            <input type="text" class="form_input" name="forename" placeholder="Vorname" />
            <input type="text" class="form_input" name="surname" placeholder="Nachname"/>
        </label>
        <label>
            <input type="text" class="form_input" name="street" placeholder="Straße"/>
            <input type="text" class="form_input" name="number" placeholder="Nummer"/>
            <input type="text" class="form_input" name="postcode" placeholder="PLZ"/>
            <input type="text" class="form_input" name="city" placeholder="Stadt"/>
        </label>
        <label>
            <input type="email" class="form_input" name="email" placeholder="E-Mail"/>
        </label>
        <label>
            <input type="password" class="form_input" name="password" placeholder="Passwort"/>
            <input type="password" class="form_input" name="password2" placeholder="Passwort wiederholen"/>
        </label>
        <button type="submit">Log In</button>
        <?php if (isset($errorMessage)) { ?>
            <div class="error">
                <?=$errorMessage?>
            </div>
        <?php} if(isset($infoMessage)) { ?>
            <div class="info">
                <?=$infoMessage?>
            </div>
        <?php } ?>

    </form>
</div>

</body>
</html>