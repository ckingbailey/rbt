<?php
include('SQLFunctions.php');
session_start();



    $link = f_sqlConnect();
    //$table = pages;
        
    //if(!f_tableExists($link, $table, DB_Name)) {
    //    die('<br>Destination table does not exist: '.$table);
    //}
    
    $System = "SELECT S.System, COUNT(C.GroupToResolve) FROM CDL C LEFT JOIN System S ON C.GroupToResolve=S.SystemID GROUP BY System ORDER BY S.System"; //Count Actions by System
    $Sev = "SELECT S.SeverityName, COUNT(C.Severity) FROM CDL C LEFT JOIN Severity S ON C.Severity=S.SeverityID WHERE C.Status=1 GROUP BY Severity ORDER BY S.SeverityName"; 
    $Status = "SELECT S.Status, COUNT(C.Status) FROM CDL C LEFT JOIN Status S ON C.Status=S.StatusID GROUP BY Status ORDER BY StatusID";
    $matches = "SELECT B.CompName, COUNT(Comp) FROM matches A LEFT JOIN Comp B ON B.CompID=A.comp GROUP BY comp  ORDER BY comp";
    $Comp = "SELECT CompName FROM Comp ORDER BY CompName";
    $sql1 = "SELECT COUNT(*) FROM System"; //Systems Count
    $sqlS = "SELECT COUNT(*) FROM Status"; //Status Counts
    $sqlSev = "SELECT COUNT(*) FROM Severity"; //Severity Counts
    $sqlET = "SELECT COUNT(*) FROM CDL WHERE Status=2"; //Status Closed Counts

    //echo '<br>SQL String: ' .$sql;
?>    
<HTML>
    <HEAD>
        <TITLE>SVBX Deficiency Snapshot</TITLE>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="styles.css" type="text/css"/>
    </HEAD>
<BODY>
<?php include('filestart.php') ?>   
    

    <h1>SVBX Deficiency Snapshot</h1>
    <br>
<?php
if($result = mysqli_query($link,$sql1)) {
        echo "<table style='width:18%;display:inline-block;vertical-align:top'>";
            echo "<tr>";
            echo "<th colspan='2'>Systems</th>";
            echo "</tr>";
            echo "<tr>";
            while ($row = mysqli_fetch_array($result)) {
                    echo "<td colspan='2' style='text-align:center'><a href='DisplaySystems.php' style='color:black'>{$row[0]} Systems</a></td>";
                    echo "</tr>";
            }    
}
if($result = mysqli_query($link,$System)) {
                echo "<tr>";
                echo "<th style='width:13%'>System</th>";
                echo "<th style='width:5%'>Actions</th>";
            echo "</tr>"; 
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                    echo "<td>{$row[0]}</td>";
                    echo "<td style='text-align:center'>{$row[1]}</td>";
                echo "</tr>";
            }    
            echo " </table> ";
}
if($result = mysqli_query($link,$sqlS)) {
        echo "<table style='width:18%;display:inline-block;vertical-align:top'>";
            echo "<tr>";
            echo "<th colspan='2'>Status</th>";
            echo "</tr>";
            echo "<tr>";
            while ($row = mysqli_fetch_array($result)) {
                    echo "<td colspan='2' style='text-align:center'><a href='DisplayStatus.php' style='color:black'>{$row[0]} Statuses</a></td>";
                    echo "</tr>";
            }    
}
if($result = mysqli_query($link,$Status)) {
                echo "<tr>";
                echo "<th style='width:13%'>Status</th>";
                echo "<th style='width:5%'>Items</th>";
            echo "</tr>"; 
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                    echo "<td>{$row[0]}</td>";
                    echo "<td style='text-align:center'>{$row[1]}</td>";
                echo "</tr>";
            }    
            echo " </table> ";
}
if($result = mysqli_query($link,$sqlSev)) {
        echo "<table style='width:18%;display:inline-block;vertical-align:top'>";
            echo "<tr>";
            echo "<th colspan='2'>Severities</th>";
            echo "</tr>";
            echo "<tr>";
            while ($row = mysqli_fetch_array($result)) {
                    echo "<td colspan='2' style='text-align:center'><a href='DisplaySeverity.php' style='color:black'>{$row[0]} Severities</a></td>";
                    echo "</tr>";
            }    
}
if($result = mysqli_query($link,$Sev)) {
                echo "<tr>";
                echo "<th style='width:13%'>Severity</th>";
                echo "<th style='width:5%'>Open Items</th>";
            echo "</tr>"; 
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                    echo "<td>{$row[0]}</td>";
                    echo "<td style='text-align:center'>{$row[1]}</td>";
                echo "</tr>";
            }    
            echo " </table> ";
}
            echo " </table> ";
?>
<?php include 'fileend.php';?>
</Body>
</HTML>