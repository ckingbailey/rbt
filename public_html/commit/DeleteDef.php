<?php
include('session.php');
include('sql_functions/sqlFunctions.php');

$user = "SELECT Username FROM users_enc WHERE UserID = ".$AUserID;
if($result=mysqli_query($link,$user)) {
    /*from the sql results, assign the username that returned to the $username variable*/    
    while($row = mysqli_fetch_assoc($result)) {
        $AUsername = $row['username'];
    }
}

if(!empty($_POST)) {
    $DefID = $_POST['q'];
    
    $link = f_sqlConnect();
 
    $sql = "UPDATE deficiency
            SET 
                 Status = '3'
                ,updatedBy = '".$AUsername."'
                ,LastUpdated = NOW()
            WHERE DefID = ".$DefID.";";
    //echo "sql: " .$sql. "Comment out Later";
    
    if(mysqli_query($link,$sql)) {
        echo "<br>Deleted record successfully";
    } else {
        echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
    }
    mysqli_close($link);
    header("Location: defs.php");
    
}
?>