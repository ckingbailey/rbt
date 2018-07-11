<?PHP
    include('SQLFunctions.php');
    session_start();
    $table = 'status';


    echo '<br>display full contents of the _POST: <br>';
    var_dump($_POST);

    $link = f_sqlConnect();
    $check = "SELECT * FROM $table WHERE statusName = '".$_POST['statusName']."'";
    $UserID = $_SESSION['userID'];
    $user = "SELECT Username FROM users_enc WHERE UserID = ".$UserID;
    if($result=mysqli_query($link,$user))
        {
          /*from the sql results, assign the username that returned to the $username variable*/
          while($row = mysqli_fetch_assoc($result)) {
            $Username = $row['username'];
          }
        }

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
    $sql = "INSERT INTO $table($keys, lastUpdated, updatedBy) VALUES ('$values', NOW(), '$UserID')";
    //echo '<br>sql: ' .$sql;
    //echo '<br>Num_rows: ' .$num_rows;

    if (!mysqli_query($link,$sql)) {
		echo '<br>Error: ' .mysqli_error($link);
		if(!empty($rejectredirecturl)) {
	    	//header("location: $rejectredirecturl?msg=1");
	    	echo $sql;
    }

    }else if(!empty ($rejectredirecturl)) {
            header("location: DisplayStatuses.php");
            //echo "Success";
    }
}

	mysqli_close($link);
?>
