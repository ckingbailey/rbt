<?php
include('sql_functions/sqlFunctions.php');

if(isset($_POST) & !empty($_POST)) {
    $Username = $_POST['username'];
    $Username = filter_var($Username, FILTER_SANITIZE_STRING);
    $link = f_sqlConnect();
    
    $sql = "SELECT * FROM users_enc WHERE Username = '".$Username."'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    if($count == 1){
        //echo "Send email to user with password";
    } else {
        $message = "Username does not exist";
    }
}

$r = mysqli_fetch_assoc($result);
$Password = $r['Password'];
$to = $r['Email'];
$subject = "Your Deficiency Database Password";

$body = "here is your password to access the VTA deficiency database.";
$headers = "From : robert.burns@vta.org";
if(mail($to, $subject, $body, $headers)){
    $message = "Your password is $Password";
} else {
    $message = "Failed to recover your password, please contact an administrator";
    echo "<br>$sql";
}
?>
<html>
    <head>
        <title>
            SVBX - Email Password
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </head>
    <body>
        <?php include('filestart.php') ?>
        <p><?php echo $message; ?></p>
        <?php include('fileend.php') ?>
    </body>
</html>