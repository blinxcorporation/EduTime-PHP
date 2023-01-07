<?php
include 'server.php';
?>

<!doctype html>
<html lang="en">
  <head>
   <?php
   include './components/head.php';
   ?>
    <title>Maseno | Timetabling</title>
  </head>
  
<body style="background-color: #d2d6de;">
<div class="container">

<div class="row mt-4">

<div class="col-lg-4"></div>
<div class="col-lg-4 text-center text-light" style="background-color:#00a7d0">
<img src="./static/images/logo.png"  class="img-fluid" height="120" width="120"/>
    <h2 class="text-center">Staff Login</h2>
</div>
<div class="col-lg-4"></div>
</div>

<!--Login form -->
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-4 p-4" style="background-color:#ffff">
<form method="POST" action="server.php">
  <div class="form-group">
    <label for="exampleInputEmail1">PF Number</label>
    <input type="text" name="pfNumber" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="PF Number">
    <small id="emailHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  
  <div class="row">
  <div class="col-md-4">
  <a name="reset_password_btn" class="btn btn-warning text-light btn-block">Forgot Password?</a>
  </div>
  <div class="col-md-4"></div>
    <div class="col-md-4">
    <button type="submit" name="login_btn" class="btn btn-info btn-block">Sign In</button>
    </div>
  
    
  </div>
</form>
</div>
<div class="col-lg-4"></div>


</div>
</div>

<?php
include "./components/footer.php";
?>
    <!-- Optional JavaScript -->

<?php
include "./components/script.php";
?>
  </body>
</html>