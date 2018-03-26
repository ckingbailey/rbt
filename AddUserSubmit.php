<?php
require_once('SQLFunctions.php');
//include('session.php');
session_start();

$AUserID = $_SESSION['UserID'];
$AUser = "SELECT Username FROM users_enc WHERE UserID = ".$AUserID;
$link = f_sqlConnect();

if($result=mysqli_query($link,$AUser)) 
    {
      /*from the sql results, assign the username that returned to the $username variable*/    
      while($row = mysqli_fetch_assoc($result)) {
        $AUsername = $row['Username'];
      }
    }

if(!isset( $_POST['username'], $_POST['pwd']))
{
    $message = 'Please enter a valid username and password';
}
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'incorrect length for username';
}
elseif (strlen( $_POST['pwd']) > 20 || strlen($_POST['pwd']) < 4)
{
    $message = 'incorrect length for password';
}
elseif (ctype_alnum($_POST['username']) != true)
{
    $message = "Username must be alpha numeric";
}
elseif (ctype_alnum($_POST['pwd']) != true)
{
    $message = "Password must be alpha numeric";
}
elseif (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) 
{
    $message = "Invalid email format"; 
}
elseif (ctype_alnum($_POST['Company']) != true)
{
    $message = "Company must be alpha numeric";
}
else {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $fname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $firstname = $link->real_escape_string($fname);
    $lname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $lastname = $link->real_escape_string($lname);
    $company = filter_var($_POST['Company'], FILTER_SANITIZE_STRING);
    $Company = $link->real_escape_string($company);
    $pwd = password_hash($pass, PASSWORD_BCRYPT);
    $role = 'V';

    try {
        
        $sql = "SELECT 1 FROM users_enc WHERE Username = '".$username."'";
        $sql1 = "SELECT 1 FROM users_enc WHERE Email = '".$email."'";
        if ($result=mysqli_query($link, $sql)) {
            if(mysqli_num_rows($result)>=1) {
                $message = "Username already exists";
            } elseif($result=mysqli_query($link, $sql1)) {
            if(mysqli_num_rows($result)>=1) {
                $message = "Email already is already in use";
            } else {
            $sql = "INSERT INTO users_enc (Username, Password, Email, firstname, lastname, Role, Created_by, Company, DateAdded) VALUES ('".$username."', '".$pwd."', '".$email."', '".$firstname."', '".$lastname."', '".$role."', '".$AUsername."', '".$Company."', NOW())";
                if(mysqli_query($link,$sql)) {
                    //echo $sql;
                    header("location: stats.php");
                } else {
                    echo "<br>Error :".$sql."<br>".mysql_error($link); 
                }
            }
            }
        }
    } catch(Exception $e) { 
        $message = "Unable to process request";
        }
}

?>

<html>
    <head>
        <title>Adding user failed</title>
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </head>
    <body>
        <?php include('filestart.php');
        echo "<h1>Adding user failed</h1>";
        echo $message;
        include('fileend.php') ?>
    </body>
</html>