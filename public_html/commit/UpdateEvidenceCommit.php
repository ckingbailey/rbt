<?php
include('sql_functions/sqlFunctions.php');
include('session.php');
// session_start();

if(!empty($_POST)) {
    $EviTypeID = $_POST['EviTypeID'];
    $EviType = $_POST['EviType'];
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
    
    $sql = "UPDATE evidenceType
            SET EviTypeName = '$EviType'
                ,updatedBy = '$UserID'
                ,lastUpdated = NOW()
            WHERE EviTypeID = $EviTypeID";
            
        if(mysqli_query($link,$sql)) {
            $_SESSION['successMsg'] = $msg = "Evidence type #$EviTypeID updated successfully";
            $redirectLocation = 'DisplayEviType.php?msg=1';
        } else {
            $_SESSION['errorMsg'] = $msg = "Error: unable to update evidence type #$EviTypeID";
            $redirectLocation = $redirectLocation = 'DisplayEviType.php?msg=1';
        }
        header("Location: $redirectLocation");
        mysqli_close($link);
        exit;
}
?>