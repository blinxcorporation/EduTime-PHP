<?php
$username="PF06";
$password = "Maseno@2023";

  // create the hashed password
$encrypted_password = md5($username).sha1($password);

echo $encrypted_password;



// function generateSchoolId() {
//   $universityCode = "UNIV"; // Replace this with your university's code
//   $randomNumber = mt_rand(1000, 9999); // Generate a random number between 1000 and 9999
//   $timestamp = time(); // Get the current Unix timestamp
//   $schoolId = $universityCode . "-" . $randomNumber . "-" . $timestamp; // Combine the parts to form the school ID
//   return $schoolId;
// }

// // Example usage:
// $schoolId = generateSchoolId();
?>