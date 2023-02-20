<?php
ob_start();
session_start();

// connect to the database
try {
  $db = mysqli_connect('localhost', 'benson', 'benson', 'timetable');
} catch(Exception $e) {
  echo 'Database Connection Failed.';
}

$errors = array();

// LOGIN STAFF
if (isset($_POST['login_btn'])) {
  $username = trim($_POST['pf_number']);
  $password = $_POST['staff_password'];

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $encrypted_password = md5($username).sha1($password);

    $login_query = "SELECT * FROM user_details WHERE `pf_number`='$username' AND `user_password`='$encrypted_password'";
    $results = mysqli_query($db, $login_query);

    if (mysqli_num_rows($results) == 1) {
      $row = mysqli_fetch_assoc($results);

      //sessions
      $_SESSION['pfno'] = $row['pf_number'];
      $_SESSION['fname'] = $row['user_firstname'];
      $_SESSION['lname'] = $row['user_lastname'];
      $_SESSION['email'] = $row['user_email'];
      $_SESSION['tel'] = $row['user_phone'];
      $_SESSION['success'] = "You are now logged in";

      header('location: ./dashboard/index.php');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: index.php');
    }
  }
}


ob_end_flush();
?>
