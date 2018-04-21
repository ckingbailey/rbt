<?php
include('SQLFunctions.php');
session_start();

    $title = "SVBX - Home";
    $link = f_sqlConnect();
    //$table = pages;
    
    $System = "SELECT S.System, COUNT(C.GroupToResolve) FROM CDL C LEFT JOIN System S ON C.GroupToResolve=S.SystemID GROUP BY System ORDER BY S.System"; //Count Actions by System
    $Sev = "SELECT S.SeverityName, COUNT(C.Severity) FROM CDL C LEFT JOIN Severity S ON C.Severity=S.SeverityID WHERE C.Status=1 GROUP BY Severity ORDER BY S.SeverityName"; 
    $Status = "SELECT S.Status, COUNT(C.Status) FROM CDL C LEFT JOIN Status S ON C.Status=S.StatusID GROUP BY Status ORDER BY StatusID";
    $location = "SELECT L.LocationName, COUNT(C.Location) FROM CDL C LEFT JOIN Location L ON L.LocationID=C.Location GROUP BY Location  ORDER BY L.LocationName";
    $Comp = "SELECT CompName FROM Comp ORDER BY CompName";
    $sqlSys = "SELECT COUNT(*) FROM System"; //Systems Count
    $sqlStat = "SELECT COUNT(*) FROM Status"; //Status Counts
    $sqlSev = "SELECT COUNT(*) FROM Severity"; //Severity Counts
    $sqlLoc = "SELECT COUNT(*) FROM Location"; //Location Counts
    $sqlET = "SELECT COUNT(*) FROM CDL WHERE Status=2"; //Status Closed Counts
        
    // vars to pass to JS scripts    
    $statusOpen = 0;
    $statusClosed = 0;
    $blockSev = 0;
    $critSev = 0;
    $majSev = 0;
    $minSev = 0;

    //if(!f_tableExists($link, $table, DB_Name)) {
    //    die('<br>Destination table does not exist: '.$table);
    //}
    
    // array of tables to render as cards
    // each item MUST include TableName, PluralString, ItemString, SqlString
    // if any extra content is needed, add it to index after required items
    $cards = [
      ['Status', 'Statuses', 'Items', 
        "<div class='data-display'><div id='open-closed-graph' class='chart-container'></div><p id='open-closed-legend' class='flex-column'></p></div>"],
      ['Severity', 'Severities', 'Open Items', '<div class="data-display"><div id="severity-graph" class="chart-container"></div><p id="open-closed-legend" class="legend"></p></div>'],
      ['System', 'Systems', 'Actions'],
      ['Location', 'Locations', 'Open Items']
    ];
    $queries = [
      'Status' => 'SELECT S.Status, COUNT(C.Status) FROM CDL C LEFT JOIN Status S ON C.Status=S.StatusID GROUP BY Status ORDER BY StatusID',
      'Severity' => 'SELECT S.SeverityName, COUNT(C.Severity) FROM CDL C LEFT JOIN Severity S ON C.Severity=S.SeverityID WHERE C.Status=1 GROUP BY Severity ORDER BY S.SeverityName',
      'System' => 'SELECT S.System, COUNT(C.GroupToResolve) FROM CDL C LEFT JOIN System S ON C.GroupToResolve=S.SystemID GROUP BY System ORDER BY S.System',
      'Location' => 'SELECT L.LocationName, COUNT(C.Location) FROM CDL C LEFT JOIN Location L ON L.LocationID=C.Location GROUP BY Location  ORDER BY L.LocationName'
    ];
    
    function writeDashCard($tot, $qry, $cardSpecs) {
      global $statusOpen, $statusClosed, $blockSev, $critSev, $majSev, $minSev;
      if ($db) $dbConnect = 'connection successful';
      echo "
        <div class='card dash-card'>
          <header class='card-header'>
            <p style='margin: 0; font-size: .75rem; color: crimson'>{$dbConnect}</p>
            <h4>{$cardSpecs[1]}</h4>
          </header>
          <div class='card-body grey-bg'>
            <ul class='dash-list'>
              <li class='bg-secondary text-white dash-list-heading'>
                <span class='dash-list-left dash-list-name'>{$cardSpecs[0]}</span>
                <span class='dash-list-right dash-list-count'>{$cardSpecs[2]}</span>
              </li>";
      if ($tot && $qry) {
        while ($row = mysqli_fetch_array($qry)) {
          if ($row[0] == 'Open') $statusOpen = $row[1];
          elseif ($row[0] == 'Closed') $statusClosed = $row[1];
          elseif ($row[0] == 'Blocker') $blockSev = $row[1];
          elseif ($row[0] == 'Critical') $critSev = $row[1];
          elseif ($row[0] == 'Major') $majSev = $row[1];
          elseif ($row[0] == 'Minor') $minSev = $row[1];
          echo "
              <li class='dash-list-item'>
                <span class='dash-list-left'>{$row[0]}</span>
                <span class='dash-list-right'>{$row[1]}</span>
              </li>
          ";
          if ($row[1] == 2) {
            echo "<script>console.log('{$row[0]}: ', '{$row[1]}');</script>";
          }
        }
        echo "</ul>";
        if (count($cardSpecs) > 3) {
          echo "{$cardSpecs[3]}</div>";
        } else echo "</div>";
        echo "
            <footer class='card-footer'>
              <a href='Display{$cardSpecs[1]}.php' class='btn btn-lg btn-outline btn-a'>Number of {$cardSpecs[1]} {$tot}</a>
            </footer>
        ";
      } else echo "</ul><p class='empty-qry-msg'>0 items returned from database</p>";
      echo "</div>";
    }

    include('filestart.php'); //Provides all HTML starting code
?> 
<header class="container page-header">
  <h1 class="page-title">Database Information</h1>
</header>
<main role="main" class="container main-content dashboard">
  <?php
  foreach($cards as $card) {
    $tableStr = 'SELECT COUNT(*) FROM '.$card[0];
    $count = mysqli_fetch_array(mysqli_query($link, $tableStr))[0];
    $cardData = mysqli_query($link, $queries[$card[0]]);
    writeDashCard($count, $cardData, $card);
  }
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
