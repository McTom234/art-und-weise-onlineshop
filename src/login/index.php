<?php

if (session_status() === 1) {
    session_start();

    $pdo = require 'database/connect.php';
}


if (isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();

    //check password
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        header("Location: ../");
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig!";
    }


}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/forms.css"/>
</head>

<body>

<div class="page_form">
    <form id="menu" action="?login=1" method="post">
        <h1>Login</h1>
        <label>
            <input type="email" class="form_input" name="username" placeholder="E-Mail"/>
        </label>
        <label>
            <input type="password" class="form_input" name="password" placeholder="Password"/>
        </label>
        <button type="submit">Log In</button>
        <div class="error">
            <?php if (isset($errorMessage)) {
                echo $errorMessage;
            }
            ?>
        </div>
    </form>
</div>
</body>

</html>