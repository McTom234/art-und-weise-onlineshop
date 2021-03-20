<?php 
session_start();

$pdo = require '../database/connect.php';

 
if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $forename = $_POST['forename'];
    $surname = $_POST['surname'];

    $street = $_POST['street'];
    $street_number = $_POST['number'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];


    if(strlen($email) == 0) {
        $errorMessage = 'Bitte eine E-Mail angeben';
        $error = true;
    }

    if(strlen($forename) == 0 || strlen($surname) == 0) {
        $errorMessage = 'Bitte einen Namen angeben';
        $error = true;
    }

    if(strlen($street) == 0 || strlen($street_number) == 0 || strlen($postcode) == 0 || strlen($city) == 0) {
        $errorMessage = 'Bitte eine Adresse angeben';
        $error = true;
    }

    if(strlen($password) == 0) {
        $errorMessage = 'Bitte ein Passwort angeben';
        $error = true;
    }
    if($password != $password2) {
        $infoMessage = 'Die Passwörter müssen übereinstimmen';
        $error = true;
    }

    if(!$error) { 
        $statement = $pdo->prepare("SELECT user_ID FROM user WHERE email = :username");
        $statement->execute(array('username' => $email));
        $user = $statement->fetch();
        
        if($user !== false) {
            $errorMessage = 'Dieser Benutzername ist bereits vergeben';
            $error = true;
        }    
    }

    if(!$error) {    
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // create user in User
        $statement = $pdo->prepare("INSERT INTO user (email, password, forename, surname) VALUES (:username, :password, :forename, :surname);");
        $result = $statement->execute(array('username' => $email, 'password' => $password_hash, 'forename' => $forename, 'surname' => $surname));

        // fetch new user_ID by email
        $statement = $pdo->prepare("SELECT user_ID FROM user WHERE email = :email");
        $statement->execute(array('email' => $email));
        $user_ID = $statement->fetch()['user_ID'];

        // create new location in Location
        $statement = $pdo->prepare("INSERT INTO location (user_ID, street, street_number, postcode, city) VALUES (:uid, :st, :nu, :pc, :ci);");
        $result = $statement->execute(array('uid' => $user_ID, 'st' => $street, 'nu' => $street_number, 'pc' => $postcode, 'ci' => $city));

        // fetch new location_ID by user_ID
        $statement = $pdo->prepare("SELECT location_ID FROM location WHERE user_ID = :uid");
        $statement->execute(array('uid' => $user_ID));
        $location_ID = $statement->fetch()['location_ID'];

        // update location_ID of user in User by user_ID
        $statement = $pdo->prepare("UPDATE user SET location_ID = :loc WHERE user_ID = :uid");
        $result = $statement->execute(array('uid' => $user_ID, 'loc' => $location_ID));
        
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
    <title>Registrierung</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/forms.css" />
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
        <div class="error">
            <?php if (isset($errorMessage)) {
                echo $errorMessage;
            }
            elseif (isset($infoMessage)) {
                echo $infoMessage;
            }
            ?>
        </div>
    </form>
</div>

</body>
</html>