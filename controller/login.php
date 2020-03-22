<?php
session_start();

require('../model/dbConnection.php');
require('../model/dbFunctions.php');
require('../model/inputFilter.php');

if (!empty($_POST)) {
  //Retrieve the field values from our login form.
  $username = !empty($_POST['login-username']) ? inputFilter($_POST['login-username']) : null;
  $password = !empty($_POST['login-password']) ? inputFilter($_POST['login-password']) : null;
  //check if the login details entered correctly
  validateUser($username, $password);
}

?>