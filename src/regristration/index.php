<?php 
session_start();

$pdo = require '../database/connect.php';

 
if(isset($_GET['register'])) {
    $error = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
      
    if(strlen($password) == 0) {
        $errorMessage = 'Bitte ein Passwort angeben';
        $error = true;
    }
    if($password != $password2) {
        $infoMessage = 'Die Passwörter müssen übereinstimmen';
        $error = true;
    }

    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();
        
        if($user !== false) {
            $errorMessage = 'Dieser Benutzername ist bereits vergeben';
            $error = true;
        }    
    }

    if(!$error) {    
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $result = $statement->execute(array('username' => $username, 'password' => $password_hash));
        
        if($result) {        
            $infoMessage = 'Du wurdest erfolgreich registriert.';
        } else {
            $errorMessage = 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regristration</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/forms.css" />
</head>
<body>
<div class="page_form">
    <form id="menu" action="?register=1" method="post">
        <h1>Regristration</h1>
        <label>
            <input type="email" class="form_input" name="username" placeholder="E-Mail"/>
        </label>
        <label>
            <input type="password" class="form_input" name="password" placeholder="Password"/>
            <input type="password" class="form_input" name="password2" placeholder="Repeat Password"/>
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

 
</body>
</html>