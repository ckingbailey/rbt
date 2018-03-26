<?php 
include('session.php');
include('SQLFunctions.php');
$link = f_sqlConnect();
$Role = $_SESSION['Role'];
$table = System;
$title = "SVBX - Display Status Types";
include('filestart.php');
        //echo '<br>Source table: ' .$table;
        
    if(!f_tableExists($link, $table, DB_Name)) {
        die('<br>Destination table does not exist: '.$table);
    }
    
    $sql = "SELECT SystemID, System, Update_TS, Updated_by FROM $table ORDER BY System";
    $sql1 = "SELECT COUNT(*) FROM $table";
    
    if($result = mysqli_query($link,$sql1)) {
        echo"   <div class='jumbotron'>
                <h1>Systems</h1><br />
                <table class='sumtable'>
                    <tr class='sumtr'>
                        <td class='sumtd'>Systems: </td>";
            while ($row = mysqli_fetch_array($result)) {
                    echo "<td class='sumtd'>{$row[0]}</td>";
            }    
            echo "</table><br>";
}
        if($result = mysqli_query($link,$sql)) {
        echo"   
                <div class='container'>
                <table class='usertable'>
                    <tr class='usertr'>
                        <th class='userth'>System ID</th>
                        <th class='userth'>System</th>";
                        if(!isset($_SESSION['UserID'])) 
                        {
                        echo "</tr>";
                        } else {
                        echo "
                            <th class='userth'>Last Updated</th>
                            <th class='userth'>Last Updated By</th>
                            <th class='userth'>Edit</th>";
                            if($Role == 'S') {
                                echo "
                            <th class='userth'>Delete</th>";
                            }
                            echo"
                            </tr>"; 
                        }
            while ($row = mysqli_fetch_array($result)) {
        echo"       <tr class='usertr'>
                        <td style='text-align:center' class='usertd'>{$row[0]}</td>
                        <td class='usertd'>{$row[1]}</td>";
                        if(!isset($_SESSION['UserID'])) 
                        {
                            echo "</tr>";
                        } else {
                        echo "
                        <td class='usertd'>{$row[2]}</td>
                        <td class='usertd'>{$row[3]}</td>
                        <td class='usertd' style='text-align:center'><form action='UpdateSystem.php' method='POST' onsubmit=''/>
                        <input type='hidden' name='q' value='".$row[0]."'/><input type='submit' value='Update'></form></td>";
                            if($Role == 'S') {
                                echo "
                        <td class='usertd' style='text-align:center'><form action='DeleteSystem.php' method='POST' onsubmit='' onsubmit='' onclick='return confirm(`do you want to delete {$row[1]} Status`)'/>
                        <input type='hidden' name='q' value='".$row[0]."' /><input type='Submit' value='delete'></form></td>";
                            }
                        echo "
                    </tr>";
                    }
            }    
            echo "</table><br></div>";
    }
    mysqli_free_result($result);
    
    if(mysqli_error($link)) {
        echo '<br>Error: ' .mysqli_error($link);
    } else //echo '<br>Success';
    
    mysqli_close($link);
    include 'fileend.php';
?>