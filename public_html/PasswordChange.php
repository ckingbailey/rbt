<?php

include('session.php');
// session_start();
$Username = $_POST['username'];
$oldpw = ($_POST['oldpw']);
$newpw = ($_POST['newpw']);

    
if(empty($oldpw))
{
    $message = 'Please enter your old password';
}
elseif (strlen( $_POST['newpw']) > 20 || strlen($_POST['newpw']) < 4)
{
    $message = 'incorrect length for new password';
}
elseif (ctype_alnum($_POST['newpw']) != true)
{
    $message = "New password must be alpha numeric";
}
elseif ($_POST['newpw'] <> $_POST['conpw'])
{
    $message = "Your new passwords do not match";
}
elseif(!empty($_POST)) {
    $UserID = $_POST['userID'];
    $oldpwd = filter_var($_POST['oldpw'], FILTER_SANITIZE_STRING);
    $newpwd = filter_var($_POST['newpw'], FILTER_SANITIZE_STRING);
    
    try {
        
        include('sql_functions/sqlFunctions.php');
        $link = f_sqlConnect();
        
        // check whether username exists
        $query = "SELECT Password FROM users_enc WHERE  Username='".$Username."'";
        if($result=mysqli_query($link,$query)) {
        while($row = mysqli_fetch_assoc($result)) {
            $get_password = $row['Password'];
            }
        } else {
            $message = "Username does not exist";
        }
        
        // check that old password is correct
        $auth = password_verify($oldpwd, $get_password);
            
        if($auth == 1) {
        $new_pwd = password_hash($newpwd, PASSWORD_BCRYPT);
        
                $query = "
                        UPDATE 
                            users_enc 
                        SET 
                            Password = '$new_pwd'
                            ,updated_By = '$Username'
                            ,LastUpdated = NOW()
                        WHERE 
                            Username = '$Username'";
                            
              mysqli_query($link, $query) or
                    die("Insert failed. " . mysqli_error($link));
              
              $message = "<p class='message'>Your password has been changed</p>";
              
              mysqli_free_result($result);
            } else {
               // Username or password is incorrect
                $message = "<p class='message'>Error: Your username and password do not match.</p>" ;
            } 
        } catch(Exception $e) { $message = "Unable to process request";
}
}
?>
<html>
    <head>
        <title>
            SVBX - Update Password
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </head>
    <body>
        <?php include('filestart.php') ?>
        <p><?php echo $message;?></p>
        <?php include('fileend.php') ?>
    </body>
</html>