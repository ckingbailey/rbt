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
      <header class="container page-header">
        <h1 class="page-title">Database Information</h1>
      </header>
      <main role="main" class="container main-content">
        <?php
        // vars to pass to JS scripts    
        $statusOpen = 0;
        $statusClosed = 0;
        $blockSev = 0;
        $critSev = 0;
        $majSev = 0;
        $minSev = 0;

        //Systems Status Table
          if($result = mysqli_query($link,$sql1)) {
            echo "
              <table class='table svbx-table dash-table'>
                <tr class='svbx-tr'>
                  <th colspan='2' class='svbx-th'>Systems</th>
                </tr>
                <tr class='svbx-tr'>";
                while ($row = mysqli_fetch_array($result)) {
                echo "
                  <td colspan='2' class='svbx-td def-tot'><a href='DisplaySystems.php' class='def-link'>{$row[0]} Systems</a></td>
                </tr>";
                }    
          }
          if($result = mysqli_query($link,$System)) {
            echo "
              <tr class='svbx-tr'>
                <th style='width:15%' class='svbx-th'>System</th>
                <th style='width:5%' class='svbx-th'>Actions</th>
              </tr>"; 
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <tr class='svbx-tr'>
                    <td class='svbx-td def-name'>{$row[0]}</td>
                    <td class='svbx-td def-count'>{$row[1]}</td>
                  </tr>";
              }    
              echo " </table> ";
          }
          //Status Status Table
          if($result = mysqli_query($link,$sqlS)) {
            echo "
              <table class='table svbx-table dash-table'>
                <tr class='svbx-tr'>
                  <th colspan='2' class='svbx-th'>Status</th>
                </tr>
              <tr class='svbx-tr'>";
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <td colspan='2' class='svbx-td def-tot'><a href='DisplayStatus.php' class='def-link'>{$row[0]} Statuses</a></td>
                </tr>";
              }
          }
          if($result = mysqli_query($link,$Status)) {
            echo "
              <tr class='svbx-tr'>
                <th style='width:15%' class='svbx-th'>Status</th>
                <th style='width:5%' class='svbx-th'>Items</th>
              </tr>";
              while ($row = mysqli_fetch_array($result)) {
                if ($row[0] == 'Open') $statusOpen = $row[1];
                if ($row[0] == 'Closed') $statusClosed = $row[1];
                echo "
                  <tr class='svbx-tr'>
                    <td class='svbx-td def-name'>{$row[0]}</td>
                    <td class='svbx-td def-count'>{$row[1]}</td>
                  </tr>";
              }    
          }
          if ($statusOpen && $statusClosed) {
            echo "
              <tr>
                <td colspan='2'>
                  <div class='data-display'>
                    <div id='open-closed-graph' class='chart-container'></div>
                    <p id='open-closed-legend' class='legend'></p>
                  </div>
                </td>
              </tr>
              </table>
            ";
          }
          else echo "</table>";

          //Severity Status Table
          if($result = mysqli_query($link,$sqlSev)) {
            echo "
              <table class='table svbx-table dash-table'>
                <tr class='svbx-tr'>
                  <th colspan='2' class='svbx-th'>Severities</th>
                </tr>
                <tr class='svbx-tr'>";
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <td colspan='2' class='svbx-td def-tot'><a href='DisplaySeverity.php' class='def-link'>{$row[0]} Severities</a></td>
                  </tr>";
              }    
          }
          if($result = mysqli_query($link,$Sev)) {
            echo "
              <tr class='svbx-tr'>
                <th style='width:10%' class='svbx-th'>Severity</th>
                <th style='width:10%' class='svbx-th'>Open Items</th>
              </tr>"; 
              while ($row = mysqli_fetch_array($result)) {
                if ($row[0] == 'Blocker') $blockSev = $row[1];
                elseif ($row[0] == 'Critical') $critSev = $row[1];
                elseif ($row[0] == 'Major') $majSev = $row[1];
                elseif ($row[0] == 'Minor') $minSev = $row[1];
                echo "
                  <tr class='svbx-tr'>
                    <td class='svbx-td def-name'>{$row[0]}</td>
                    <td class='svbx-td def-count'>{$row[1]}</td>
                  </tr>";
              }
              if ($blockSev OR $critSev OR $majSev OR $minSev) {
                echo "
                  <tr>
                    <td colspan='2'>
                      <div class='data-display'>
                        <div id='severity-graph' class='chart-container'></div>
                        <p id='severity-legend' class='legend'></p>
                      </div>
                    </td>
                  </tr>
                  </table>
                ";
              }
              echo " </table> ";
          }
          else echo " </table> ";
          //Location Status Table
          if($result = mysqli_query($link,$sqlLoc)) {
            echo "
              <table class='table svbx-table dash-table'>
                <tr class='svbx-tr'>
                  <th colspan='2' class='svbx-th'>Locations</th>
                </tr>
                <tr class='svbx-tr'>";
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <td colspan='2' class='svbx-td def-tot'><a href='DisplayLocations.php' class='def-link'>{$row[0]} Locations</a></td>
                  </tr>";
              }    
          }
          if($result = mysqli_query($link,$location)) {
            echo "
              <tr class='svbx-tr'>
                <th style='width:10%' class='svbx-th'>Location</th>
                <th style='width:10%' class='svbx-th'>Open Items</th>
              </tr>"; 
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <tr class='svbx-tr'>
                    <td class='svbx-td def-name'>{$row[0]}</td>
                    <td class='svbx-td def-count'>{$row[1]}</td>
                  </tr>";
              }    
              echo " </table> ";
          }
              echo " </table> ";
        ?> 
    </main>
  <?php
    echo "
    <!--THIS IS A TERRIBLE WAY TO DO THIS
        THIS IS ONLY FOR TESTING PURPOSES-->
    <script src='https://d3js.org/d3.v5.js'></script>
    <script src='js/pie_chart.js'></script>
    <script>
      window.drawOpenCloseChart(window.d3, '".$statusOpen."', '".$statusClosed."')
      window.drawSeverityChart(window.d3, '".$blockSev."', '".$critSev."', '".$majSev."', '".$minSev."')
    </script>
    <!--REMOVE ABOVE SCRIPT TAGS ONCE TESTING IS DONE-->
    <!--DO NOT TYPE BELOW THIS LINE-->";
    include('fileend.php');
  ?>
