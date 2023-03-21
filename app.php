<?php
$username="PF08";
$password="Maseno@2023";
$encrypted_password = md5($username).sha1($password);
echo $encrypted_password;
?>