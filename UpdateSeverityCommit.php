<?php
include('SQLFunctions.php');
include('session.php');
session_start();

if(!empty($_POST)) {
    $SeverityID = $_POST['SeverityID'];
    $SeverityName = $_POST['SeverityName'];
    $Description = $_POST['Description'];
    $UserID = $_SESSION['UserID'];
    $link = f_sqlConnect();
    
    $user = "SELECT Username FROM users_enc WHERE UserID = ".$UserID;
    if($result=mysqli_query($link,$user)) 
        {
          /*from the sql results, assign the username that returned to the $username variable*/    
          while($row = mysqli_fetch_assoc($result)) {
            $Username = $row['Username'];
          }
        }
    
    $sql = "UPDATE Severity
            SET SeverityName = '".$SeverityName."'
                ,Description = '".$Description."'
                ,Updated_by = '".$Username."'
                ,Update_TS = NOW()
            WHERE SeverityID = ".$SeverityID.";";

            if(mysqli_query($link,$sql)) {
                echo "<br>Update Completed successfully";
        } else {
            echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
        }
        mysqli_close($link);
        header("Location: DisplaySeverity.php");
        //echo "<br>Username: ".$sql;
}
?>