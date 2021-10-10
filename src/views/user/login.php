<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/user-forms.css"/>
</head>

<body>

<?php
$loggedIn = false;
$navbar_index = "login";
require __DIR__ . '/../layout/navbar.php';
?>

<main>
    <form id="menu" action="?login=1<?php if($buy) echo'&buy=1'?>" method="post">
        <h2>Login</h2>
        <input id="email" type="email" name="email" placeholder=" "/>
        <label for="email">E-Mail</label>
        <input id="password" type="password" name="password" placeholder=" "/>
        <label for="password">Passwort</label>
        <button type="submit">Log In</button>
        <a class="link-button" href="/registration">Registrieren</a>

        <?php if (isset($message)) { ?>
            <div class="error">
                <?=$message?>
            </div>
        <?php } ?>

    </form>
</main>

<?php require __DIR__ . '/../layout/footer.php'; ?>

</body>

</html>