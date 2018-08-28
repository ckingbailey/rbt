<?php  
session_start();
require 'sqlFunctions.php';

$redirectPath = '/';
$timeout = 180;

if ($_SERVER['PHP_SELF'] !== '/index.php'
    && $_SERVER['PHP_SELF'] !== '/login.php'
    && ($_SERVER['PHP_SELF'] !== '/loginSubmit.php'
    && empty($_POST)))
  {
  if (!isset($_SESSION['userID'])) {
      /* Redirect If Not Logged In */
      header("Location: $redirectPath");
      exit; /* prevent other code from being executed*/
  } else {
    // check for session timeout
    if ($_SESSION['timeout'] + $timeout * 60 < time()) {
      /* session timed out */
      header("Location: logout.php");
    } else {
      /*if the user isn't timed out, update the session timeout variable to the current time.*/
       $_SESSION['timeout'] = time();
    }
  }
}
