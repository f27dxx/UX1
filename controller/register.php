<?php
session_start();
require('../model/dbConnection.php');
require('../model/dbFunctions.php');
require('../model/inputFilter.php');



//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(!empty([$_POST])) {
    
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['username']) ? inputFilter($_POST['username']) : null;
    $password = !empty($_POST['password']) ? inputFilter($_POST['password']) : null;
    $privilege = 2;
    // $firstname = !empty($_POST['firstname']) ? inputFilter($_POST['firstname']) : null;
    // $lastname = !empty($_POST['lastname']) ? inputFilter($_POST['lastname']) : null;
    // $email = !empty($_POST['email']) ? inputFilter($_POST['email']) : null;
    //Hash the password as we do NOT want to store our passwords in plain text.
    $hpassword = password_hash($password, PASSWORD_DEFAULT);

    $query = $conn->prepare('SELECT username FROM login WHERE username = :user');
    $query->bindValue(':user', $username);
    $query->execute();

    if($query->rowCount()<1){
        newUser($username, $hpassword, $privilege);

        echo 'user added';
    } else {
        echo 'user already exist';
    }
}

?>