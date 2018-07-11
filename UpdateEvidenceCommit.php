<?php
include('SQLFunctions.php');
include('session.php');
session_start();

if(!empty($_POST)) {
    $EviTypeID = $_POST['EviTypeID'];
    $EviType = $_POST['EviType'];
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
    
    $sql = "UPDATE EvidenceType
            SET EviTypeName = '".$EviType."'
                ,updatedBy = '"$UserID"'
                ,lastUpdated = NOW()
            WHERE EviTypeID = ".$EviTypeID.";";

            if(mysqli_query($link,$sql)) {
                echo "<br>Update Completed successfully";
        } else {
            echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
        }
        mysqli_close($link);
        header("Location: DisplayEviType.php?msg=1");
        //echo "<br>SQL: ".$sql;
}
?>