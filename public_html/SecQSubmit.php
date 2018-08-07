<?php
    require_once('sql_functions/sqlFunctions.php');
    include('session.php');
    
    /* Check that question & answer are populated */
    if(!isset( $_POST['SecA'], $_POST['SecQ'])) {
        $message = 'Please select a question and enter an answer';
        $location = 'setSQ.php';
    }
    /* Check answer for alpha numeric characters */
    elseif (ctype_alnum($_POST['SecA']) != true) {
        $message = "Answer must be alpha numeric";
        $location = 'setSQ.php';
    }
    else {
    
    //if(isset($_POST['submit'])) {
        
        $link = f_sqlConnect();
        $SecQ = filter_input(INPUT_POST, 'SecQ', FILTER_SANITIZE_STRING);
        $SecA = filter_input(INPUT_POST, 'SecA', FILTER_SANITIZE_STRING);
        $SecA = password_hash($SecA, PASSWORD_DEFAULT);
        $userID = $_SESSION['userID'];
        
        if(!isset($userID)) {
            $message = "No user logged in";
            $location = 'setSQ.php';
        } else {
            $query = "
                UPDATE 
                    users
                SET 
                    SecQ = '$SecQ'
                    ,SecA = '$SecA'
                    ,updatedBy = '$userID'
                    ,LastUpdated = NOW()
                WHERE 
                    userID = '$userID'";
                
            mysqli_query($link, $query) or
                die("Insert failed. " . mysqli_error($link));
              
            //$message = "<p class='message'>Your security question has been saved</p>";
            $location = 'dashboard.php';
        }
    }
if (!empty($message)) $_SESSION['errorMsg'] = $message;
header("Location: $location");
mysqli_close($link);
exit;