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
ob_end_flush();
?>