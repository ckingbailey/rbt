<?php
include('session.php');
include('sql_functions/sqlFunctions.php');

if(!empty($_POST)) {
    $SevID = $_POST['q'];
    
    $link = f_sqlConnect();
 
    $sql = "DELETE 
            FROM severity
            WHERE SeverityID = $SevID";
    
    if(mysqli_query($link,$sql)) {
        echo "<br>Deleted record successfully";
    } else {
        echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
    }
    mysqli_close($link);
    header("Location: DisplaySeverities.php");
}
?>