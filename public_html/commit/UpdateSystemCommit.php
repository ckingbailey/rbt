<?php
include('sql_functions/sqlFunctions.php');
// include('Session.php');
session_start();

if(!empty($_POST)) {
    $SystemID = $_POST['SystemID'];
    $System = $_POST['SystemName'];
    $UserID = $_SESSION['userID'];
    $link = f_sqlConnect();
    
    $user = "SELECT Username FROM users_enc WHERE UserID = ".$UserID;
    if($result=mysqli_query($link,$user)) 
        {
          /*from the sql results, assign the username that returned to the $username variable*/    
          while($row = mysqli_fetch_assoc($result)) {
            $Username = $row['username'];
          }
        }
    
    $sql = "UPDATE system
            SET SystemName = '$System'
                ,updatedBy = '$UserID'
                ,lastUpdated = NOW()
            WHERE SystemID = $SystemID";

        if(!mysqli_query($link,$sql)) {
            echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
            mysqli_close($link);
            exit;
        }
        mysqli_close($link);
        header("Location: DisplaySystems.php?msg=1");
        //echo "<br>Username: ".$Username;
        //echo "<br>UserID: ".$user;        
}
?>