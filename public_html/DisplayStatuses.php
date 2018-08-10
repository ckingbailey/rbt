<?php
include('session.php');
include('sql_functions/sqlFunctions.php');
$table = 'status';
$title = "SVBX - Display Status Types";
include('filestart.php');
$link = f_sqlConnect();

    if(!f_tableExists($link, $table, DB_Name)) {
        die('<br>Destination table does not exist: '.$table);
    }

    $sql = "SELECT statusID, statusName, lastUpdated, updatedBy FROM $table ORDER BY StatusID";
    $sql1 = "SELECT COUNT(*) FROM $table";

    if($result = mysqli_query($link,$sql1)) {
        echo"   <header class='container page-header'>
                <h1 class='page-title'>Status Types</h1><br />
                <table class='sumtable'>
                    <tr class='sumtr'>
                        <td class='sumtd'>Status Types: </td>";
            while ($row = mysqli_fetch_array($result)) {
                    echo "<td class='sumtd'>{$row[0]}</td>";
            }
            echo "</table><br></header>";
}
    if($result = mysqli_query($link,$sql)) {
        echo"
                <div class='container main-content'>
                <table class='table'>
                    <tr class='usertr'>
                        <th class='userth'>Status ID</th>
                        <th class='userth'>Status</th>";
                        if(!isset($_SESSION['userID']))
                        {
                        echo "</tr>";
                        } else {
                        echo "
                            <th class='userth'>Last Updated</th>
                            <th class='userth'>Last Updated By</th>
                            <th class='userth'>Edit</th>";
                            if($Role >= 40) {
                                echo "
                            <th class='userth'>Delete</th>";
                            }
                            echo "
                            </tr>";
                        }
            while ($row = mysqli_fetch_array($result)) {
        echo"       <tr class='usertr'>
                        <td style='text-align:center' class='usertd'>{$row[0]}</td>
                        <td class='usertd'>{$row[1]}</td>";
                        if(!isset($_SESSION['userID']))
                        {
                            echo "</tr>";
                        } else {
                        echo "
                        <td class='usertd'>{$row[2]}</td>
                        <td class='usertd'>{$row[3]}</td>
                        <td class='usertd'><form action='UpdateStatus.php' method='POST' onsubmit=''/>
                        <input type='hidden' name='q' value='".$row[0]."'/><input type='submit' value='Update'></form></td>";
                        if($Role >= 40) {
                                echo "
                        <td class='usertd'><form action='DeleteStatus.php' method='POST' onsubmit='' onsubmit='' onclick='return confirm(`do you want to delete {$row[1]} Status`)'/>
                        <button type='Submit' name='q' value='".$row[0]."'><i class='typcn typcn-times'></i></button></form></td>";
                        }
                        echo "</tr>";
                    }
            }
            echo "</table></div>";
    }
    mysqli_free_result($result);

    if(mysqli_error($link)) {
        echo '<br>Error: ' .mysqli_error($link);
    } else //echo '<br>Success';

    mysqli_close($link);
    include 'fileend.php';
?>
