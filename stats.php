<?php
include('SQLFunctions.php');
session_start();


    $title = "SVBX - Home";
    $link = f_sqlConnect();
    //$table = pages;
        
    //if(!f_tableExists($link, $table, DB_Name)) {
    //    die('<br>Destination table does not exist: '.$table);
    //}
    
    $System = "SELECT S.System, COUNT(C.GroupToResolve) FROM CDL C LEFT JOIN System S ON C.GroupToResolve=S.SystemID GROUP BY System ORDER BY S.System"; //Count Actions by System
    $Sev = "SELECT S.SeverityName, COUNT(C.Severity) FROM CDL C LEFT JOIN Severity S ON C.Severity=S.SeverityID WHERE C.Status=1 GROUP BY Severity ORDER BY S.SeverityName"; 
    $Status = "SELECT S.Status, COUNT(C.Status) FROM CDL C LEFT JOIN Status S ON C.Status=S.StatusID GROUP BY Status ORDER BY StatusID";
    $location = "SELECT L.LocationName, COUNT(C.Location) FROM CDL C LEFT JOIN Location L ON L.LocationID=C.Location GROUP BY Location  ORDER BY L.LocationName";
    $Comp = "SELECT CompName FROM Comp ORDER BY CompName";
    $sql1 = "SELECT COUNT(*) FROM System"; //Systems Count
    $sqlS = "SELECT COUNT(*) FROM Status"; //Status Counts
    $sqlSev = "SELECT COUNT(*) FROM Severity"; //Severity Counts
    $sqlLoc = "SELECT COUNT(*) FROM Location"; //Location Counts
    $sqlET = "SELECT COUNT(*) FROM CDL WHERE Status=2"; //Status Closed Counts

    //echo '<br>SQL String: ' .$sql;
    include('filestart.php'); //Provides all HTML starting code
?> 
    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Database Information</h1>
        </div>
      </div>
      <div class="container">
        <?php
        //Systems Status Table
          if($result = mysqli_query($link,$sql1)) {
            echo "
              <table class='svbxtable'>
                <tr class='svbxtr'>
                  <th colspan='2' class='svbxth'>Systems</th>
                </tr>
                <tr class='svbxtr'>";
                while ($row = mysqli_fetch_array($result)) {
                echo "
                  <td colspan='2' class='svbxtd'  style='text-align:center'><a href='DisplaySystems.php' style='color:black'>{$row[0]} Systems</a></td>
                </tr>";
                }    
          }
          if($result = mysqli_query($link,$System)) {
            echo "
              <tr class='svbxtr'>
                <th style='width:15%' class='svbxth'>System</th>
                <th style='width:5%' class='svbxth'>Actions</th>
              </tr>"; 
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <tr class='svbxtr'>
                    <td class='svbxtd'>{$row[0]}</td>
                    <td style='text-align:center' class='svbxtd'>{$row[1]}</td>
                  </tr>";
              }    
              echo " </table> ";
          }
          //Status Status Table
          if($result = mysqli_query($link,$sqlS)) {
            echo "
              <table class='svbxtable'>
                <tr class='svbxtr'>
                  <th colspan='2' class='svbxth'>Status</th>
                </tr>
              <tr class='svbxtr'>";
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <td colspan='2' style='text-align:center' class='svbxtd><a href='DisplayStatus.php' style='color:black'>{$row[0]} Statuses</a></td>
                </tr>";
              }    
          }
          if($result = mysqli_query($link,$Status)) {
            echo "
              <tr class='svbxtr'>
                <th style='width:15%' class='svbxth'>Status</th>
                <th style='width:5%' class='svbxth'>Items</th>
              </tr>";
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <tr class='svbxtr'>
                    <td class='svbxtd'>{$row[0]}</td>
                    <td style='text-align:center' class='svbxtd'>{$row[1]}</td>
                  </tr>";
              }    
              echo " 
              </table> ";
          }
          //Severity Status Table
          if($result = mysqli_query($link,$sqlSev)) {
            echo "
              <table class='svbxtable'>
                <tr class='svbxtr'>
                  <th colspan='2' class='svbxth'>Severities</th>
                </tr>
                <tr class='svbxtr'>";
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <td colspan='2' style='text-align:center' class='svbxtd'><a href='DisplaySeverity.php' style='color:black'>{$row[0]} Severities</a></td>
                  </tr>";
              }    
          }
          if($result = mysqli_query($link,$Sev)) {
            echo "
              <tr class='svbxtr'>
                <th style='width:10%' class='svbxth'>Severity</th>
                <th style='width:10%' class='svbxth'>Open Items</th>
              </tr>"; 
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <tr class='svbxtr'>
                    <td class='svbxtd'>{$row[0]}</td>
                    <td class='svbxtd' style='text-align:center'>{$row[1]}</td>
                  </tr>";
              }    
              echo " </table> ";
          }
              echo " </table> ";
          //Location Status Table
          if($result = mysqli_query($link,$sqlLoc)) {
            echo "
              <table class='svbxtable'>
                <tr class='svbxtr'>
                  <th colspan='2' class='svbxth'>Locations</th>
                </tr>
                <tr class='svbxtr'>";
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <td colspan='2' style='text-align:center' class='svbxtd'><a href='DisplaySeverity.php' style='color:black'>{$row[0]} Locations</a></td>
                  </tr>";
              }    
          }
          if($result = mysqli_query($link,$location)) {
            echo "
              <tr class='svbxtr'>
                <th style='width:10%' class='svbxth'>Location</th>
                <th style='width:10%' class='svbxth'>Open Items</th>
              </tr>"; 
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <tr class='svbxtr'>
                    <td class='svbxtd'>{$row[0]}</td>
                    <td class='svbxtd' style='text-align:center'>{$row[1]}</td>
                  </tr>";
              }    
              echo " </table> ";
          }
              echo " </table> ";
        ?> 
      </div><!-- /container -->

    </main>
    <!--DO NOT TYPE BELOW THIS LINE-->
    <?php include('fileend.php'); ?>
