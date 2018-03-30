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
    
    // display Page Heading
    if($result = mysqli_query($link,$sql1)) {
        echo"   <header class='page-header'>
                    <h1 class='page-title'>Systems</h1>
                </header>
                <main class='main-content data-page'>
                    <table class='sumtable'>
                        <tr class='sumtr'>
                            <td class='sumtd'>Systems:</td>";
                            while ($row = mysqli_fetch_array($result)) {
                                    echo "<td class='sumtd'>{$row[0]}</td>";
                            }    
        echo"   </tr></table>";
    }
    
    // display Deficiency Table
    if($result = mysqli_query($link,$sql)) {
        echo"   <table class='table def-table'>
                    <tr class='def-tr'>
                        <th class='userth'>ID</th>
                        <th class='userth'>System</th>";
                        if(!isset($_SESSION['UserID'])) 
                        {
                        echo "</tr>";
                        } else {
                        echo "
                            <th class='userth'>Last Update</th>
                            <th class='userth'>Updated By</th>
                            <th class='userth'>Edit</th>";
                            if($Role == 'S') {
                                echo "
                            <th class='userth'>Delete</th>";
                            }
                            echo"
                            </tr>"; 
                        }
            while ($row = mysqli_fetch_array($result)) {
        echo"       <tr class='def-tr'>
                        <td class='usertd'>{$row[0]}</td>
                        <td class='usertd'>{$row[1]}</td>";
                        if(!isset($_SESSION['UserID'])) 
                        {
                            echo "</tr>";
                        } else {
                        echo "
                            <td class='usertd'>{$row[2]}</td>
                            <td class='usertd'>{$row[3]}</td>
                            <td class='usertd'><form action='UpdateSystem.php' method='POST' onsubmit=''>
                                <button type='submit' name='q' value='.$row[0].'><i class='typcn typcn-edit'></i></button></form></td>";
                            if($Role == 'S') {
                                echo "
                                <td class='usertd'><form action='DeleteSystem.php' method='POST' onsubmit='' onclick='return confirm(`do you want to delete {$row[1]} Status`)'/>
                                <button type='Submit' name='q' value='".$row[0]."'><i class='typcn typcn-times'></i></button></form></td>";
                            }
                        echo "</tr>";
                    }
            }    
            echo "</table>";
    }
    mysqli_free_result($result);
    
    if(mysqli_error($link)) {
        echo 'Error: ' .mysqli_error($link);
    } else //echo 'Success';
    
    mysqli_close($link);
    include 'fileend.php';
?>