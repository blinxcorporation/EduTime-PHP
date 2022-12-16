<?php 
ob_start();
session_start();
// // Report all PHP errors
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

//##############################///
// connect to the database
try{
$db = mysqli_connect('localhost', 'benson', 'benson', 'timetable');
//$db = mysqli_connect('localhost', 'blinxcok_benson', 'aFek]Np@ZVPZ', 'blinxcok_maseno_e_help');
// echo 'Database Connected Successfully';
}
catch(Exception $e) {
  // echo 'Message: ' .$e->getMessage();
  echo 'Database Connection Failed.';
}

    // LOGIN STAFF
    if (isset($_POST['login_btn'])) {
      $username = $_POST['pfNumber'];
      $password = $_POST['password'];

      if (empty($username)) {
        array_push($errors, "Username is required");
      }
      if (empty($password)) {
        array_push($errors, "Password is required");
      }

      if (count($errors) == 0) {
        $encrypted_password = md5($password);
        $login_query = "SELECT * FROM lecturer_details WHERE `pf_number`='$username' AND `password`='$encrypted_password'";
        $results = mysqli_query($db, $login_query);

        if (mysqli_num_rows($results) == 1) {
          $row = mysqli_fetch_assoc($results);
        // end generate random alphanumeric character
          //row data
          $pfnumber=$row['pf_number'];
          $pass=$row['password'];
          $fname=$row['firstname'];
          $lname=$row['lastname'];
          $mail=$row['email'];
          $phone=$row['phone'];
          
          //sessions
          $_SESSION['pfno'] = $pfnumber;
          $_SESSION['fname'] = $fname; 
          $_SESSION['lname'] = $lname; 
          $_SESSION['email'] = $mail; 
          $_SESSION['tel'] = $phone; 
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