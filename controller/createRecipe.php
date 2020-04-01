<?php 
session_start();
require('../model/dbConnection.php');
require('../model/inputFilter.php');
require('../model/dbFunctions.php');


if (!empty([$_POST])) {
  //input sanitation via testInput function
  $recipeName = !empty($_POST['recipeName'])? inputFilter(($_POST['recipeName'])): null;
  $recipeDes = !empty($_POST['recipeDes'])? inputFilter(($_POST['recipeDes'])): null;
  $quantity1 = !empty($_POST['quantity1'])? inputFilter(($_POST['quantity1'])): null;
  $measurement1 = !empty($_POST['measurement1'])? inputFilter(($_POST['measurement1'])): null;
  $item1 = !empty($_POST['item1'])? inputFilter(($_POST['item1'])): null;
  $quantity2 = !empty($_POST['quantity2'])? inputFilter(($_POST['quantity2'])): null;
  $measurement2 = !empty($_POST['measurement2'])? inputFilter(($_POST['measurement2'])): null;
  $item2 = !empty($_POST['item2'])? inputFilter(($_POST['item2'])): null;
  $step1 = !empty($_POST['step1'])? inputFilter(($_POST['step1'])): null;
  $step2 = !empty($_POST['step2'])? inputFilter(($_POST['step2'])): null;
  
  //insert data to database
  insertRecipe($recipeName, $recipeDes, $quantity1, $measurement1, $item1, $quantity2, $measurement2, $item2, $step1, $step2);
  // header('Location: /at1/index.php');
  echo 'inserted i guess';
} else {
  echo 'smt wrong';

}
?>