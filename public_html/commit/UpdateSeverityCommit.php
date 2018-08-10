<?php
include('sql_functions/sqlFunctions.php');
include('session.php');

if(!empty($_POST)) {
    $SeverityID = $_POST['SeverityID'];
    $SeverityName = $_POST['SeverityName'];
    $Description = $_POST['Description'];
    $UserID = $_SESSION['userID'];
    $link = f_sqlConnect();
    
    // $user = "SELECT Username FROM users_enc WHERE UserID = " . $UserID;
    // if($result=mysqli_query($link,$user)) {
    //   /*from the sql results, assign the username that returned to the $username variable*/    
    //   while($row = mysqli_fetch_assoc($result)) {
    //     $Username = $row['username'];
    //   }
    // }
    
    $sql = "UPDATE severity
            SET SeverityName = '$SeverityName'
                ,severityDescrip = '$Description'
                ,updatedBy = '$UserID'
                ,lastUpdated = NOW()
            WHERE SeverityID = $SeverityID";

        if (!mysqli_query($link,$sql)) {
            echo "<br>Error: " . $sql . "<br>" . mysqli_error($link);
            mysqli_close($link);
            exit;
        }
        mysqli_close($link);
        header("Location: DisplaySeverities.php");
        exit;
}