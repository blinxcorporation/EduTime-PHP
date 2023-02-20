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
  $username = $_POST['pf_number'];
  $password = $_POST['staff_password'];

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    // generate a random salt
    $salt = "acd40505fd3d8b1d6cf58ad7916ade92176b33d1b11bcf75f01151f84694f4ef802862b2";

    // create the hashed password
    $hashed_password = hash('sha256', $salt.$password);

    // prepare the SQL statement
    $stmt = $db->prepare("SELECT * FROM user_details WHERE pf_number=?");
    $stmt->bind_param("s", $username);

    // execute the SQL statement
    $stmt->execute();

    // get the result set
    $result = $stmt->get_result();

    // check if the user exists
    if ($result->num_rows == 1) {
      // get the user's record
      $row = $result->fetch_assoc();

      // verify the password
      if (hash_equals($row['user_password'], hash('sha256', $salt.$password))) {
        // row data
        $pfnumber = $row['pf_number'];
        $fname = $row['user_firstname'];
        $lname = $row['user_lastname'];
        $mail = $row['user_email'];
        $phone = $row['user_phone'];

        // set session variables
        $_SESSION['pfno'] = $pfnumber;
        $_SESSION['fname'] = $fname; 
        $_SESSION['lname'] = $lname; 
        $_SESSION['email'] = $mail; 
        $_SESSION['tel'] = $phone; 
        $_SESSION['success'] = "You are now logged in";

        // redirect to the dashboard
        header('location: ./dashboard/index.php');
        exit;
      } else {
        // password is incorrect
        array_push($errors, "Incorrect Username or Password");
      }
    } else {
      // user does not exist
      array_push($errors, "Incorrect Username or Password");
    }

    // close the prepared statement
    $stmt->close();
  }
}

// close the database connection
mysqli_close($db);

// output any errors
if (count($errors) > 0) {
  echo "<ul>";
  foreach ($errors as $error) {
    echo "<li>$error</li>";
  }
  echo "</ul>";
}

ob_end_flush();
?>
