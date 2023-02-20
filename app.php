<?php
$username="PF05";
$password = "Maseno@2023";

  // create the hashed password
$encrypted_password = md5($username).sha1($password);

echo $encrypted_password;
?>