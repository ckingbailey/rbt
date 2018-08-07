<?php
include('session.php');
include('sql_functions/sqlFunctions.php');
$table = 'location';
$title = "SVBX - Display Locations";
include('filestart.php');
$link = f_sqlConnect();
        //echo '<br>Source table: ' .$table;

    // if(!f_tableExists($link, $table, DB_Name)) {
    //     die('<br>Destination table does not exist: '.$table);
    // }

    $sql = "SELECT LocationID, LocationName, lastUpdated, updatedBy FROM $table ORDER BY LocationName";
    $sql1 = "SELECT COUNT(*) FROM $table";

    if($result = mysqli_query($link,$sql1)) {
        echo"
                <header class='container page-header'>
                <h1 class='page-title'>Locations</h1><br />
                <table class='sumtable'>
                    <tr class='sumtr'>
                        <td class='sumtd'>Locations in Database: </td>";
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
                        <th class='userth'>Location ID</th>
                        <th class='userth'>Location</th>";
                        if(!isset($_SESSION['userID']))
                        {
                        echo "</tr>";
                        } else {
                        echo "
                            <th class='userth'>Last Updated</th>
                            <th class='userth'>Updated By</th>";
                                if($Role >= 30) {
                            echo "
                            <th class='userth'>Edit</th>";
                                }
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
                        <td class='usertd'>{$row[3]}</td>";
                            if($Role >= 30) {
                            echo "
                        <td class='usertd'><form action='UpdateLocation.php' method='POST' onsubmit=''/>
                        <input type='hidden' name='q' value='".$row[0]."'/><input type='submit' value='Update'></form></td>";
                            }
                        if($Role >= 40) {
                            echo "
                        <td class='usertd'><form action='DeleteLocation.php' method='POST' onsubmit='' onsubmit='' onclick='return confirm(`do you want to delete {$row[1]} location`)'/>
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

?>
<?php include 'fileend.php';?>
</Body>
</HTML>
