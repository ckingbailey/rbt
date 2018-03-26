<?PHP
    include('SQLFunctions.php');
    Session_Start();
    $table = System;
    

    echo '<br>display full contents of the _POST: <br>';
    var_dump($_POST);
    
    $link = f_sqlConnect();
    $check = "SELECT * FROM $table WHERE System = '".$_POST['Status']."'";
    $UserID = $_SESSION['UserID'];
    $Username = $_SESSION['Username'];
    
    $keys = implode(", ", (array_keys($_POST)));
    echo '<br>Parsed Key: ' .$keys;
    $values = implode("', '", (array_values($_POST)));
    echo '<br>Parsed Values: ' .$values;
    
    if(!f_tableExists($link, $table, DB_Name)) {
        die('<br>Destination table does not exist:'.$table);
    }
    
    $result = mysqli_query($link,$check);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
      header("location: $duplicate?msg=1");
    }
    else {
    $sql = "INSERT INTO $table($keys, Update_TS, Updated_by) VALUES ('$values', NOW(), '$Username')";
    //echo '<br>sql: ' .$sql;
    //echo '<br>Num_rows: ' .$num_rows;
    
    if (!mysqli_query($link,$sql)) {
		echo '<br>Error: ' .mysqli_error($link);
		if(!empty($rejectredirecturl)) {
	    	//header("location: $rejectredirecturl?msg=1");
	    	echo $sql;
    }    
	
    }else if(!empty ($rejectredirecturl)) {
            header("location: DisplaySystems.php");
            //echo "SQL: ".$sql;
            //echo "Success";
    }
}
    
	mysqli_close($link);
?>