<?php
//add new user to tables login and users
function newUser($username, $hpassword, $privilege) {
  global $conn;
  try {
    //make sure they run at the same time
    $conn->beginTransaction();
     //insert to login
    $sql = 'INSERT INTO login(username, password, privilege) VALUES (:username, :hpassword, :privilege)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':hpassword', $hpassword);
    $stmt->bindValue(':privilege', $privilege);
    $stmt->execute();
    
    //get the LoginID
    // $lastLoginID = $conn->lastInsertId();
    // $sql = 'INSERT INTO users(FirstName, LastName, Email, LoginID) VALUES (:firstname, :lastname, :email, :LoginID)';
    // $stmt = $conn->prepare($sql);
    // $stmt->bindValue(':firstname', $firstname);
    // $stmt->bindValue(':lastname', $lastname);
    // $stmt->bindValue(':email', $email);
    // $stmt->bindValue(':LoginID', $lastLoginID);
    // $stmt->execute();
   
    
   //save into database
    $conn->commit();

  } catch(PDOException $ex) {
    $conn->rollBack();
    throw $ex;

  }
}

//login function
//check if the user exist
function  validateUser($username, $password) {
  global $conn;
  try {
    $sql = 'SELECT user_id, password, privilege FROM login WHERE username = :username';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    if(password_verify($password, $row['password'])) {
      // assign session variables
      $_SESSION['username'] = $username;
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['privilege'] = $row['privilege'];
      $_SESSION['logged_in'] = 'yes';
      echo 'logged in bruh';
    } else {
      echo 'username/password incorrect';
    }
  } catch(PDOException $ex) {
    throw $ex;
  }
  
}

//create recipe
function  insertRecipe(
  $recipeName, $recipeDes, $quantity1, $measurement1, $item1, $quantity2, $measurement2, $item2, $step1, $step2
  ){
  global $conn;
  try {
    $conn->beginTransaction();
    //insert to login
    $user_id = $_SESSION['user_id'];
    $sql = 'INSERT INTO recipe(name, description, user_id) VALUES (:name, :description, :user_id)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':name', $recipeName);
    $stmt->bindValue(':description', $recipeDes);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    
    //get BookID from stmt above
    $recipe_id = $conn->lastInsertId();
    
    $sql = 'INSERT INTO ingredient(recipe_id, quantity, measurement, item) VALUES (:recipe_id, :quantity, :measurement, :item)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':recipe_id', $recipe_id);
    $stmt->bindValue(':quantity', $quantity1);
    $stmt->bindValue(':measurement', $measurement1);
    $stmt->bindValue(':item', $item1);
    $stmt->execute();

    $sql = 'INSERT INTO ingredient(recipe_id, quantity, measurement, item) VALUES (:recipe_id, :quantity, :measurement, :item)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':recipe_id', $recipe_id);
    $stmt->bindValue(':quantity', $quantity2);
    $stmt->bindValue(':measurement', $measurement2);
    $stmt->bindValue(':item', $item2);
    $stmt->execute();

    $sql = 'INSERT INTO method(recipe_id, step) VALUES (:recipe_id, :step)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':recipe_id', $recipe_id);
    $stmt->bindValue(':step', $step1);
    $stmt->execute();

    $sql = 'INSERT INTO method(recipe_id, step) VALUES (:recipe_id, :step)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':recipe_id', $recipe_id);
    $stmt->bindValue(':step', $step2);
    $stmt->execute();

    $conn->commit();
  

  } catch(PDOException $ex) {
    $conn->rollBack();
    throw $ex;
  }
} 
?>

