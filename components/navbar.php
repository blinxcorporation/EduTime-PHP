<?php
include './server.php';
?>
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
      
   
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><?php echo $fname ." ".$lname?></a>
          <a class="dropdown-item" href="#">Chair</a>
          <div class="dropdown-divider"></div>
          <a type="button" class="text-danger text-center" href="logout.php">Logout</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Labaratories</a>
      </li>
      
    </ul>
  
  </div>
</nav>