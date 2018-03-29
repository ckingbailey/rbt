<?php  
session_start();

if(!isset($_SESSION['UserID']))
{
    /* Redirect If Not Logged In */
    header("Location: login.php");
    exit; /* prevent other code from being executed*/
} else {
  /*we are going to start tracking a new session variable we will call timeout.
   by comparing the session timeout plus 600 seconds to the current time, 
   we can force users to the logout page when they attempt to access the page, after 10 mins of inaction*/
  if ($_SESSION['timeout'] + 180 * 60 < time()) {
    /* session timed out */
    header("Location: logout.php");
  } else {
    /*if the user isn't timed out, update the session timeout variable to the current time.*/
     $_SESSION['timeout'] = time();
  }
}
?>