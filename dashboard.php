<?php
include 'server.php';

//Redeclaring Variables on sessions
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
?>

<!doctype html>
<html lang="en">
  <head>
   <?php
   include './components/head.php';
   ?>
    <title>Dashboard || Timetabling</title>
  </head>
  
<body style="background-color: #d2d6de;">

<h1><?php echo $fname ." ".$lname?></h1>


<!--Script-->
<?php
include "./components/script.php";
?>
  </body>
</html>