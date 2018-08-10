<?php
include('sql_functions/sqlFunctions.php');
// include('Session.php');
session_start();

if(!empty($_POST)) {
    $StatusID = $_POST['StatusID'];
    $Status = $_POST['StatusName'];
    $UserID = $_SESSION['userID'];
    $link = f_sqlConnect();
    
    $user = "SELECT username FROM users_enc WHERE UserID = ".$UserID;
    if($result=mysqli_query($link,$user)) 
        {
          /*from the sql results, assign the username that returned to the $username variable*/    
          while($row = mysqli_fetch_assoc($result)) {
            $Username = $row['username'];
          }
        }
    
    $sql = "UPDATE status
            SET StatusName = '".$Status."'
                ,updatedBy = '".$UserID."'
                ,lastUpdated = NOW()
            WHERE StatusID = ".$StatusID.";";

            if(mysqli_query($link,$sql)) {
                echo "<br>Update Completed successfully";
        } else {
            echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
        }
        mysqli_close($link);
        header("Location: DisplayStatuses.php?msg=1");
        //echo "<br>Username: ".$Username;
        //echo "<br>UserID: ".$user;        
}
?>