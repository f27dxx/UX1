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
?>

