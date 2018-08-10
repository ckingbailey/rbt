<?php
session_start();

// Unset all of the session variables.  
session_unset();

// Destroy the session.
session_destroy();
?>
<html>
  <head>
    <title>Log Out</title>
    <link rel="stylesheet" href="styles.css" type="text/css"/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  </head>
  <body>
  <?php include('filestart.php'); 
        header("Location: login.php");
        include 'fileend.php'; ?>
  </body>
</html>