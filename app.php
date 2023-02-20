<?php
  $password = "Maseno@2023";
  $salt = "acd40505fd3d8b1d6cf58ad7916ade92176b33d1b11bcf75f01151f84694f4ef802862b2";
// echo $salt;
  // create the hashed password
  $hashed_password = hash('sha256', $salt.$password);

echo $hashed_password;
?>