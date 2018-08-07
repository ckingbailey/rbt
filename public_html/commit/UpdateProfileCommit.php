<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include('sql_functions/sqlFunctions.php');
include('session.php');
$AUserID = $_SESSION['userID'];
$link = f_sqlConnect();
$title = "Update User Commit";

$user = "SELECT username FROM users_enc WHERE userID = ".$AUserID;
if($result=mysqli_query($link,$user)) {
    /*from the sql results, assign the username that returned to the $username variable*/
    while($row = mysqli_fetch_assoc($result)) {
        $AUsername = $row['username'];
    }
}

if($_POST['Password'] <> '') {
    $pwd = '1';
    if($_POST['Password'] <> $_POST['ConPwd']) {
        $message = 'Confirmation password does not match new password';
    }
    if (ctype_alnum($_POST['Password']) != true) {
        $message = "Password must be alpha numeric";
    }
} else {
    $pwd = '0';
}

if(!isset($_POST['username']))
{
    $message = 'Please enter a valid username';
}
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'incorrect length for Username';
}
elseif (ctype_alnum($_POST['username']) != true)
{
    $message = "Username must be alpha numeric";
}
elseif (ctype_alnum($_POST['Company']) != true)
{
    $message = "Company must be alpha numeric";
}
elseif (filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) !=true)
{
    $message = "Email is not a valid email address";
}
elseif(!empty($_POST)) {
    $UserID = $_POST['userID'];
    $SecQ = $_POST['SecQ'];
    $Username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $company = filter_var($_POST['Company'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
    $SecA = filter_var($_POST['SecA'], FILTER_SANITIZE_STRING);
    $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    // $Role = $_POST['role'];
    $Password = password_hash($password, PASSWORD_BCRYPT);

    if($pwd == '0') {

    try {

    $sql = "UPDATE users_enc
            SET  Username = '$Username'
                ,firstname = '$firstname'
                ,lastname = '$lastname'
                ,Email = '$Email'
                ,Company = '$company'
                ,SecQ = '$SecQ'
                ,SecA = '$SecA'
                ,updated_By = '$AUsername'
                ,LastUpdated = NOW()
            WHERE UserID = $UserID";

            if(mysqli_query($link,$sql)) {
                header('location: displayUsers.php');

        } else {
            echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
        }
        mysqli_close($link);
        //header("Location: DisplayUsers.php?msg=1");
        //echo "<br>SQL: ".$sql;
    } catch(Exception $e) { $message = "Unable to process request1";}
    } elseif($pwd == '1') {

        try {

    $sql = "UPDATE users_enc
            SET  Username = '".$Username."'
                ,Password = '".$Password."'
                ,firstname = '".$firstname."'
                ,lastname = '".$lastname."'
                ,Email = '".$Email."'
                ,Company = '".$company."'
                ,SecQ = '".$SecQ."'
                ,SecA = '".$SecA."'
                ,updatedBy = '".$AUsername."'
                ,LastUpdated = NOW()
            WHERE UserID = ".$UserID.";";

            if(mysqli_query($link,$sql)) {
                header('location: displayUsers.php');
        } else {
            echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
        }
        mysqli_close($link);
        //header("Location: DisplayUsers.php?msg=1");
        //echo "<br>SQL: ".$sql;
    } catch(Exception $e) {$message = "Unable to process request2";}
    } else {
        $message = 'Unable to process request3<br />'.$pwd;
    }
}

include('filestart.php');
    echo "
        <div class='container page-header'>
            <h1 class='page-title'>Error</h1>
        </div>
        <div class='container'>
        <p style='text-align:center'>$message</p>
        </div>";

include('fileend.php');
