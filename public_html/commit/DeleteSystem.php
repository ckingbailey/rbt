<?php
include('session.php');
?>

<?php
include('sql_functions/sqlFunctions.php');

if(!empty($_POST)) {
    $SysID = $_POST['q'];
    
    $link = f_sqlConnect();
 
    $sql = "DELETE 
            FROM system
            WHERE SystemID = $SysID";
    //echo "sql: " .$sql. "Comment out Later";
    
    if(mysqli_query($link,$sql)) {
        echo "<br>Deleted record successfully";
    } else {
        echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
    }
    mysqli_close($link);
    header("Location: DisplaySystems.php");
    
}
?>