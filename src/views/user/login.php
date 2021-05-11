<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/dist/assets/css/forms.css"/>
</head>

<body>

<div class="page_form">
    <form id="menu" action="?login=1" method="post">
        <h1>Login</h1>
        <label>
            <input type="email" class="form_input" name="email" placeholder="E-Mail"/>
        </label>
        <label>
            <input type="password" class="form_input" name="password" placeholder="Password"/>
        </label>
        <button type="submit">Log In</button>

        <?php if (isset($message)) { ?>
            <div class="error">
                <?=$message?>
            </div>
        <?php } ?>

    </form>
</div>
</body>

</html>