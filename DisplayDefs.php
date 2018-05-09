<?php 
include('session.php');
include('SQLFunctions.php');
$title = "View Deficiencies";
$link = f_sqlConnect();
$role = $_SESSION['Role'];
include('filestart.php');

$roleLvlMap = [ null, V, U, A, S ];
$roleLvl = array_search($role, $roleLvlMap);

if ($result = $link->query('SELECT bdPermit from users_enc where userID='.$_SESSION['UserID'])) {
    if ($row = $result->fetch_row()) {
        $bdPermit = $row[0];
    }
}

function concatSqlStr($arr, $table, $initStr = '') {
    $joiner = 'WHERE';
    $equality = '=';
    $qStr = $initStr;
    foreach ($arr as $key => $val) {
        if (strpos(strtolower($key), 'description') !== false) {
            $equality = ' LIKE ';
            $val = "%{$val}%";
        }
        $qStr .= " $joiner $table.{$key}{$equality}'{$val}'";
        $joiner = 'AND';
        $equality = '=';
    }
    return $qStr;
}

function printInfoBox($lvl, $href) {
    $boxStart ="<div class='card item-margin-bottom'>
            <div class='card-body flex-row justify-content-between align-items-center grey-bg'>
                <p class='mb-1'>Click Deficiency ID number to see full details</p>";
    $boxEnd ="</div></div>";
    $btn ="<a href='%s.php' class='btn btn-primary'>Add New Deficiency</a>";
    
    $box = $lvl >= 1 ? $boxStart.$btn.$boxEnd : $boxStart.$boxEnd;
            
    return sprintf($box, $href);
}

function printProjectSearchBar($cnxn, $post, $formAction) {
    // concat content to $form string until it's all written
    // then return the completed string
    $form = sprintf("
        <div class='row item-margin-bottom'>
            <form action='%s' method='%s' class='col-12'>
                <div class='row'>
                    <h5 class='col-12'>Filter deficiencies</h5>
                </div>", $formAction['action'], $formAction['method']);
    $form .= "<div class='row item-margin-bottom'>
                    <div class='col-6 col-sm-1 pl-1 pr-1'>
                        <label class='input-label'>Def #</label>
                        <select name='DefID' class='form-control'>
                            <option value=''></option>";
    if ($result = $cnxn->query('SELECT DefID from CDL')) {
        while ($row = $result->fetch_array()) {
            $select = ($post['DefID'] === $row[0]) ? 'selected' : '';
            $form .= "<option value='{$row[0]}' $select>{$row[0]}</option>";
        }
        $result->close();
    }
    $form .= "</select>
                </div>
                <div class='col-6 col-sm-2 pl-1 pr-1'>
                    <label class='input-label'>Status</label>
                    <select name='Status' class='form-control'>
                        <option value=''></option>";
    if ($result = $cnxn->query('SELECT StatusID, Status from Status')) {
        while ($row = $result->fetch_array()) {
            $select = ($post['Status'] === $row[0]) ? 'selected' : '';
            $form .= "<option value='{$row[0]}' $select>{$row[1]}</option>";
        }
        $result->close();
    }
    $form .= "</select>
                </div>
                <div class='col-6 col-sm-1 pl-1 pr-1'>
                    <label class='input-label'>Safety cert</label>
                    <select name='SafetyCert' class='form-control'>
                        <option value=''></option>
                        <option value='1'>Yes</option>
                        <option value='2'>No</option>
                    </select>
                </div>
                <div class='col-6 col-sm-2 pl-1 pr-1'>
                    <label class='input-label'>Severity</label>
                    <select name='Severity' class='form-control'>
                        <option value=''></option>";
    if ($result = $cnxn->query('SELECT SeverityID, SeverityName from Severity')) {
        while($row = $result->fetch_array()) {
            $select = ($post['Severity'] === $row[0]) ? 'selected' : '';
            $form .= "<option value='{$row[0]}' $select>{$row[1]}</option>";
        }
        $result->close();
    }
    $form .= "</select>
                </div>
                <div class='col-6 col-sm-3 pl-1 pr-1'>
                    <label class='input-label'>System</label>
                    <select name='SystemAffected' class='form-control'>
                        <option value=''></option>";
    if ($result = $cnxn->query('SELECT s.SystemID, s.System from CDL c JOIN System s ON s.SystemID=c.SystemAffected GROUP BY System ORDER BY SystemID')) {
        while ($row = $result->fetch_array()) {
            $select = ($post['SystemAffected'] === $row[0]) ? 'selected' : '';
            $form .= "<option value='{$row[0]}' $select>{$row[1]}</option>";
        }
        $result->close();
    }
    $form .= "</select>
                </div>
                <div class='col-6 col-sm-3 pl-1 pr-1'>
                    <label class='input-label'>Group to resolve</label>
                    <select name='GroupToResolve' class='form-control'>
                        <option value=''></option>";
    if ($result = $cnxn->query('SELECT s.SystemID, s.System FROM CDL c JOIN System s ON s.SystemID=c.GroupToResolve GROUP BY System ORDER BY SystemID')) {
        while ($row = $result->fetch_array()) {
            $select = ($post['GroupToResolve'] === $row[0]) ? 'selected' : '';
            $form .= "<option value='{$row[0]}' $select>{$row[1]}</option>";
        }
        $result->close();
    }
    $form .= "</select>
                </div>
            </div>
            <div class='row item-margin-bottom'>
                <div class='col-sm-4 pl-1 pr-1'>
                    <label class='input-label'>Description</label>
                    <input type='text' name='Description' class='form-control' value='{$post['Description']}'>
                </div>
                <div class='col-sm-2 pl-1 pr-1'>
                    <label class='input-label'>Location</label>
                    <select name='Location' class='form-control'>
                        <option value=''></option>";
    if ($result = $cnxn->query('SELECT l.LocationID, l.LocationName FROM CDL c JOIN Location l ON l.LocationID=c.Location GROUP BY LocationName ORDER BY LocationID')) {
        while ($row = $result->fetch_array()) {
            $select = ($post['Location'] === $row[0]) ? 'selected' : '';
            $form .= "<option value='{$row[0]}' $select>{$row[1]}</option>";
        }
        $result->close();
    }
    $form .= "</select>
                </div>
                <div class='col-sm-2 pl-1 pr-1'>
                    <label class='input-label'>Specific location</label>
                    <select name='SpecLoc' class='form-control'>";
    if ($result = $cnxn->query('SELECT SpecLoc FROM CDL GROUP BY SpecLoc')) {
        while ($row = $result->fetch_row()) {
            $select = ($post['SpecLoc'] === $row[0]) ? 'selected' : '';
            $form .= "<option value='$row[0]' $select>$row[0]</option>";
        }
        $result->close();
    }
    $form .= "</select>
                </div>
                <div class='col-sm-2 pl-1 pr-1'>
                    <label class='input-label'>Identified By</label>
                    <select name='IdentifiedBy' class='form-control'>
                        <option value=''></option>";
    if ($result = $cnxn->query('SELECT IdentifiedBy FROM CDL GROUP BY IdentifiedBy')) {
        while ($row = $result->fetch_row()) {
            $select = ($post['IdentifiedBy'] === $row[0]) ? 'selected' : '';
            $form .= "<option value='{$row[0]}' $select>{$row[0]}</option>";
        }
        $result->close();
    }
    $form .= "</select>
                </div>
                <div class='col-sm-2 pl-1 pr-1 pt-2 flex-row justify-center align-end'>
                    <button name='Search' value='search' type='submit' class='btn btn-primary item-margin-right'>Search</button>
                    <button name='Reset' value='reset' type='button' class='btn btn-primary item-margin-right' onclick='return resetSearch(event)'>Reset</button>
                </div>
            </div>
        </form>
    </div>";
    return $form;
}

function printProjectDefsTable($cnxn, $qry, $lvl) {
    if ($result = $cnxn->query($qry)) {
        if ($result->num_rows) {
            $table = "
                <table class='table table-striped table-responsive svbx-table'>
                    <thead>
                        <tr class='svbx-tr table-heading'>
                            <th class='svbx-th id-th'>ID</th>
                            <th class='svbx-th loc-th collapse-sm collapse-xs'>Location</th>
                            <th class='svbx-th sev-th collapse-xs'>Severity</th>
                            <th class='svbx-th created-th collapse-md  collapse-sm collapse-xs'>Date Created</th>
                            <th class='svbx-th status-th'>Status</th>
                            <th class='svbx-th system-th collapse-sm collapse-xs'>System Affected</th>
                            <th class='svbx-th descrip-th'>Brief Description</th>
                            <th class='svbx-th collapse-md collapse-sm collapse-xs'>Spec Loc</th>";
                    if($lvl >= 1) {
                        $table .= "
                            <th class='svbx-th updated-th collapse-md collapse-sm collapse-xs'>Last Updated</th>
                            <th class='svbx-th edit-th collapse-sm collapse-xs'>Edit</th>";
                    } $table .= "</tr></thead><tbody>";
                    
                while($row = $result->fetch_array()) {
                    $table .= "
                        <tr class='svbx-tr'>
                            <td class='svbx-td id-td'><a href='ViewDef.php?DefID={$row[0]}' class='class1'>{$row[0]}</a></td>
                            <td class='svbx-td loc-td collapse-sm collapse-xs'>{$row[1]}</td>
                            <td class='svbx-td sev-td collapse-xs'>{$row[2]}</td>
                            <td class='svbx-td created-td collapse-md  collapse-sm collapse-xs'>{$row[3]}</td>
                            <td class='svbx-td status-td'>{$row[4]}</td>
                            <td class='svbx-td system-td collapse-sm collapse-xs'>{$row[5]}</td>
                            <td class='svbx-td descrip-td'>".nl2br($row[6])."</td>
                            <td class='svbx-td collapse-md collapse-sm collapse-xs'>{$row[7]}</td>";
                    if ($lvl >= 1) {
                       $table .= "
                            <td class='svbx-td updated-td collapse-md  collapse-sm collapse-xs'>{$row[8]}</td>
                            <td class='svbx-td edit-td collapse-sm collapse-xs'>
                                <form action='UpdateDef.php' method='POST' onsubmit=''/>
                                    <button type='submit' name='q' value='".$row[0]."'><i class='typcn typcn-edit'></i></button>
                                </form>
                            </td>";
                    } else $table .= "</tr>";
                }
            $table .= "</tbody></table>";
        } else {
            $table .= "<h4 class='text-secondary text-center'>No results found for your search</h4>";
        }
        $result->close();
    } elseif ($cnxn->error) {
        $table .= "<h4 class='text-danger center-content'>Error: $cnxn->error</h4>";
    }
    return $table;
}

if($_POST['Search'] == NULL) {
    $sql = file_get_contents("CDList.sql");
    $count = "SELECT COUNT(*) FROM CDL";
} else {
    $postData = array_filter($_POST);
    unset($postData['Search']);
    
    $sql = "SELECT 
                A.DefID,
                L.LocationName, 
                S.SeverityName, 
                A.DateCreated,
                T.Status,
                Y.System, 
                A.Description,
                A.SpecLoc,
                A.LastUpdated
            FROM CDL A 
            LEFT JOIN Location L 
            ON L.LocationID = A.Location
            LEFT JOIN Severity S 
            ON S.SeverityID = A.Severity
            LEFT JOIN Status T
            ON T.StatusID = A.Status
            LEFT JOIN System Y
            ON Y.SystemID = A.SystemAffected";
    $count = "SELECT COUNT(*) FROM CDL A";
    
    $sql .= concatSqlStr($postData, 'A');
    $count .= concatSqlStr($postData, 'A');
}
?>
<header class="container page-header">
    <h1 class="page-title">Deficiencies</h1>
</header>
<?php
    echo "<main class='container main-content'>";
    echo printProjectSearchBar($link, $postData, [ method => 'POST', action => 'DisplayDefs.php' ]);
    echo printInfoBox($roleLvl, 'NewDef');
    echo printProjectDefsTable($link, $sql, $roleLvl);
    
    echo "</main>";
    echo "
        <script>
            function resetSearch(ev) {
                ev.target.form.reset();
                ev.target.form.submit();
            }
        </script>";
                    
mysqli_close($link);
    
include 'fileend.php';
?>