<?php
    require_once('SQLFunctions.php');
    
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
    
    //if(isset($_POST['submit'])) {
        
        $link = f_sqlConnect();
        $username = $_POST['Username'];
        $Username = filter_var($username, FILTER_SANITIZE_STRING);
        
        $password = $_POST['Password'];
        $Password = filter_var($password, FILTER_SANITIZE_STRING);
        
        $query = "SELECT UserID, Password, Role, secQ FROM users_enc WHERE Username = '".$Username."'";
        if($result=mysqli_query($link,$query)) {
        while($row = mysqli_fetch_assoc($result)) {
            $set_password = $row['Password'];
            $set_UserID = $row['UserID'];
            $set_Role = $row['Role'];
            $set_SecQ = $row['secQ'];
            }
        } else {
            $message = "User does not exist";
            //$echo = "SQL: " .$query;
            
        }
            
        $auth = password_verify($Password, $set_password);
            
        if($auth == 1) {
            // Set session variables
            session_start();
            $_SESSION['UserID'] = $set_UserID;
            $_SESSION['Username'] = $Username;
            $_SESSION['Role'] = $set_Role;
            $_SESSION['timeout'] = time();
            $query = "UPDATE users_enc SET LastLogin = NOW() WHERE Username = '".$Username."'";
            mysqli_query($link, $query) or
                die("Insert failed. " . mysqli_error($link));
            if($set_SecQ == 0) {
                header('location: SetSQ.php');
                } else {
                header('location: stats.php');
            //$message = "Success";
                }
            } else {
                $message = "Failed to log in";
                
            }
    }
include('filestart.php');
?>
<main role="main">

      <header class="container page-header">
        <img src="vta_logo.png">
        <h1 class="page-title">Silicon Valley Berryessa Extension</h1>
      </header>

        <div class="container">
            <h2 style="text-align:center"><?php echo $message; ?> </h2>
        </div>
        <!-- Example row of columns -->
        <!-- /container -->

    </main>
<?php 
include('fileend.php');
?>