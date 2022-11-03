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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Timetabling</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Lecturers</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Units </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Rooms</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Labaratories</a>
      </li>
      
      <li class="nav-item">
      <a type="button" class="btn btn-danger" href="logout.php">Logout</a>
      </li>
    </ul>
  
  </div>
</nav>

<h1><?php echo $fname ." ".$lname?></h1>


<!--Script-->
<?php
include "./components/script.php";
?>
  </body>
</html>