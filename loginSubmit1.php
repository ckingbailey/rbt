<?php
    require_once('SQLFunctions.php');
    session_start();
    
    /* Check if the user is already logged in */
    if(isset( $_SESSION['UserID'] ))
    {
        $message = 'User is already logged in';
    }
    /* Check that username and password are populated */
    if(!isset( $_POST['Username'], $_POST['Password']))
    {
        $message = 'Please enter a valid username and password';
    }
    /* Check username length */
    elseif (strlen( $_POST['Username']) > 20 || strlen($_POST['Username']) < 4)
    {
        $message = 'Incorrect Length for Username';
    }
    /* Check password length */
    elseif (strlen( $_POST['Password']) > 20 || strlen($_POST['Password']) < 4)
    {
        $message = 'Incorrect Length for Password';
    }
    /* Check username for alpha numeric characters */
    elseif (ctype_alnum($_POST['Username']) != true)
    {
        $message = "Username must be alpha numeric";
    }
    /* Check password for alpha numeric characters */
    elseif (ctype_alnum($_POST['Password']) != true)
    {
            $message = "Password must be alpha numeric";
    }
    else
    {
        $Username = filter_var($_POST['Username'], FILTER_SANITIZE_STRING);
        $Pass = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
        

        try
        {
            $link = f_sqlConnect();
            $query = "SELECT * FROM users_enc WHERE Username =".$Username;
            $result = mysqli_query($link, $query);
            if($row = mysqli_fetch_assoc($result)) {
                $get_password = $row['Password'];
                $input_password = crypt($Pass, $get_password);
            
                    if($input_password == $get_password) {
                        $message = "Winner";
                        $UserID = $row['UserID'];
                        //echo "<br>UserID=".$UserID;
            
                        /* Set the session user_id parameter */
                        $_SESSION['UserID'] = $UserID;
                        $_SESSION['timeout'] = time();
                        //header("Location: stats.php");
                    } else {
                        $message = "Wrong info";
                    }
                } else {
                    $message = "Wrong info again";
                }
        }
            catch(Exception $e)
        {
            $message = 'Unable to process request';
        }
    }
?>
<HTML>
    <HEAD>
        <TITLE>Login Submit</TITLE>
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </HEAD>
    <BODY>                    
        <?php   include('filestart.php');
                echo $message;
                include 'fileend.php';
        ?>
    </body>
</html>