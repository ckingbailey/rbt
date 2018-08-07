<?php
require_once 'session.php';
require_once '../vendor/autoload.php';
require_once 'sql_functions/sqlFunctions.php';
require_once '../routes/assetRoutes.php';

include 'html_functions/htmlTables.php';

$table = 'deficiency';

// instantiate Twig
$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader,
    [
        'debug' => true
    ]
);
$twig->addExtension(new Twig_Extension_Debug());
$template = $twig->load('table.html.twig');

// base context
$context = [
    'navbarHeading' => !empty($_SESSION['username'])
        ? ( !empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
            ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
            : $_SESSION['username'] )
        : '',
    'title' => 'Deficiencies List',
    'pageHeading' => 'Deficiencies',
    'tableName' => $table,
    'dataDisplayName' => 'deficiency',
    'info' => 'Click Deficiency ID number to see full details',
    'addPath' => 'newDef.php',
    'tableHeadings' => [
        'ID' => [ 'value' => 'ID', 'cellWd' => '', 'href' => '/viewDef.php?defID=' ],
        'location' => [ 'value' => 'Location', 'cellWd' => '', 'collapse' => 'sm' ],
        'severity' => [ 'value' => 'Severity', 'cellWd' => '', 'collapse' => 'xs' ],
        'dateCreated' => [ 'value' => 'Date created', 'cellWd' => '', 'collapse' => 'md' ],
        'status' => [ 'value' => 'Status', 'cellWd' => '' ],
        'systemAffected' => [ 'value' => 'System affected', 'cellWd' => '', 'collapse' => 'sm' ],
        'description' => [ 'value' => 'Description', 'cellWd' => '' ],
        'specLoc' => [ 'value' => 'Specific location', 'cellWd' => '', 'collapse' => 'md' ],
        'lastUpdated' => [ 'value' => 'Last updated', 'cellWd' => '', 'collapse' => 'md' ],
        'edit' => [ 'value' => 'Edit', 'cellWd' => '', 'collapse' => 'sm', 'href' => '/updateDef.php?defID=' ]
    ]
];

$title = "View Deficiencies";
$role = $_SESSION['role'];
$view = isset($_GET['view']) ? $_GET['view'] : '';

// include('filestart.php');

// query to see if user has permission to view BART defs
try {
    $link = connect();
    // $link->where('userid', $_SESSION['userID']);
    // $result = $link->getOne('users_enc', [ 'bdPermit' ]);
    // $bartPermit = $result['bdPermit'];
} catch (Exception $e) {
    echo "<h1 style='font-size: 4rem; font-family: monospace; color: red;'>{$e->getMessage()}</h1>";
    exit;
}

function printInfoBox($role, $href, $dataGraphic = false) {
    $dataContainer = $dataGraphic
        ? "<div class='row mb-3'><div id='dataContainer' class='col-md-4 offset-md-4 d-flex flex-row flex-wrap justify-content-start'></div></div>"
        : '';
    $box ="
        <div class='card item-margin-bottom'>
            <div class='card-body grey-bg'>
                $dataContainer
                <div class='row'>
                    <div class='col-12 d-flex flex-row flex-wrap justify-content-between align-items-center'>
                        <span class='mb-2'>Click Deficiency ID number to see full details</span>
                        %s
                    </div>
                </div>
            </div>
        </div>";
    $btn = $role > 10 ? "<a href='%s' class='btn btn-primary'>Add New Deficiency</a>" : '';

    $box = sprintf($box, $btn);

    return printf($box, $href);
}

function printSearchBar($link, $get, $formAction) {
    list($collapsed, $show) = isset($get['search']) ? ['', ' show'] : ['collapsed', ''];
    $marker = '%s';
    $formF = "
        <div class='row item-margin-bottom'>
            <form method='{$formAction['method']}' action='{$formAction['action']}' class='col-12'>
                <div class='row'>
                    <h5 class='col-12'>
                        <a
                            data-toggle='collapse'
                            href='#filterDefs'
                            role='button'
                            aria-expanded='false'
                            aria-controls='filterDefs'
                            class='$collapsed'
                        >Filter deficiencies<i class='typcn typcn-arrow-sorted-down'></i>
                        </a>
                    </h5>
                </div>
                <div class='collapse$show' id='filterDefs'>%s</div>
            </form>
        </div>";
    $rowF = "<div class='row item-margin-bottom'>%s</div>";
    $colF = "<div class='col-%s col-sm-%s pl-1 pr-1'>%s</div>";
    $labelF = "<label>%s</label>";
    $selectF = "
        <select name='%s' class='form-control'>
            <option value=''></option>
            %s
        </select>";
    $optionF = "<option value='%s'%s>%s</option>";

    $makeSelectEl = function ($labelText, $param, array $fields, array $colWds, $data) use ($get, $labelF, $selectF, $optionF, $colF)
    {
        list($inputVal, $inputText) = isset($fields[1])
            ? [ $fields[0], $fields[1] ] : [ $fields[0], $fields[0]];
        // collect <option> els in a str before sprintf <select>
        $opts = '';
        foreach ($data as $row) {
            $selected = isset($get[$param]) && $get[$param] === $row[$fields[0]]
                ? ' selected' : '';
            $opts .= sprintf($optionF, $row[$inputVal], $selected, $row[$inputText]);
        }
        $curLab = sprintf($labelF, $labelText);
        $curEl = sprintf($selectF, $param, $opts);
        // return sprintf('%s', 'CONTENT!' . '6');
        return sprintf($colF, $colWds[0], $colWds[1], $curLab . $curEl);

    };
    // collect elements w/i cols in 2 two rows
    if ($result = $link->get($table, null, 'defID')) {
        // this is the first column so we start a new $cols collector
        $cols = $makeSelectEl('Def #', 'defID', ['defID'], [6, 1], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve defID list");

    if ($result = $link->get('status', null, 'statusID, statusName')) {
        // $opts = '';
        // foreach ($result as $row) {
        //     $selected = isset($get['status']) && $get['status'] === $row['statusID']
        //         ? ' selected' : '';
        //     $opts .= sprintf($optionF, $row['statusID'], $selected, $row['statusName']);
        // }
        // $curLab = sprintf($labelF, 'Status');
        // $curEl = sprintf($selectF, 'status', $opts);
        // sprintf($colF, 6, 2, $curLab . $curEl);
        $cols .= $makeSelectEl('Status', 'status', ['statusID', 'statusName'], [6, 2], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve status list");

    if ($result = $link->get('yesNo', null, 'yesNoID, yesNoName')) {
        $cols .= $makeSelectEl('Safety cert', 'safetyCert', ['yesNoID', 'yesNoName'], [6, 1], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve safetyCert list");

    if ($result = $link->get('severity', null, 'severityID, severityName')) {
        $cols .= $makeSelectEl('Severity', 'severity', ['severityID', 'severityName'], [6, 2], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve severity list");

    $link->join('system s', 'c.systemAffected = s.systemID', 'INNER');
    $link->groupBy('systemName');
    $link->orderBy('systemID');
    if ($result = $link->get("$table c", null, 'systemID, systemName')) {
        $cols .= $makeSelectEl('System affected', 'systemAffected', ['systemID', 'systemName'], [6, 3], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve system list");

    $link->join('system s', 'c.groupToResolve = s.systemID', 'INNER');
    $link->groupBy('systemName');
    $link->orderBy('systemID');
    if ($result = $link->get("$table c", null, 'systemID, systemName')) {
        $cols .= $makeSelectEl('Group to resolve', 'groupToResolve', ['systemID', 'systemName'], [6, 3], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve groupToResolve list");

    // finish first row
    $row1 = sprintf($rowF, $cols);

    // begin new row with a fresh $cols collector
    $curLab = sprintf($labelF, 'Description');
    $curVal = isset($get['description']) ? $get['description'] : '';
    $curEl = "<input type='text' name='description' class='form-control' value='$curVal'>";
    $cols = sprintf($colF, 4, 4, $curLab . $curEl);

    $link->join('location l', 'c.location = l.locationID', 'INNER');
    $link->groupBy('locationName');
    $link->orderBy('locationID');
    if ($result = $link->get("$table c", null, 'l.locationID, l.locationName')) {
        $cols .= $makeSelectEl('Location', 'location', ['locationID', 'locationName'], [6, 2], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve location list");

    $link->groupBy('specLoc');
    if ($result = $link->get($table, null, 'specLoc')) {
        $cols .= $makeSelectEl('Specific location', 'specLoc', ['specLoc'], [6, 2], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve specLoc list");

    $link->groupBy('identifiedBy');
    if ($result = $link->get($table, null, 'identifiedBy')) {
        $cols .= $makeSelectEl('Identified by', 'identifiedBy', ['identifiedBy'], [6, 2], $result);
    } else throw new mysqli_sql_exception("Unable to retrieve identifiedBy list");

    // submit and reset buttons
    $buttons = "
            <button name='search' value='search' type='submit' class='btn btn-primary item-margin-right'>Search</button>
            <button type='button' class='btn btn-primary item-margin-right' onclick='return resetSearch(event)'>Reset</button>";
    // buttons column needs flex classes so I tack them on after bootstrap col width class
    $cols .= sprintf($colF, 12, '2 flex-row justify-center align-end', $buttons);

    // finish second row;
    $row2 = sprintf($rowF, $cols);

    $form = sprintf($formF, $row1 . $row2);

    print $form;
}

function printDefsTable($result, $tableElements, $userLvl) {
    // echo "<pre style='color: #39d;'>";
    // var_dump($result);
    // echo "</pre>";
    if (count($result)) {
        $keys = array_keys($tableElements);
        $headers = array_combine(
            $keys, array_column($tableElements, 'header')
        );
        $cells = array_combine(
            $keys, array_column($tableElements, 'cell')
        );
        echo "<table class='table table-striped table-responsive svbx-table'>";
        printTableHeadings($headers, $userLvl);
        populateTable($result, $cells, $userLvl);
        echo "</table>";
    } else
        print "<h4 class='text-secondary text-center'>No results found for your search</h4>";
}

function printProjectDefsTable($result, $userLvl) {
    $tdClassList = 'svbx-td';
    $thClassList = 'svbx-th';
    $collapseXs = 'collapse-xs';
    $collapseSm = 'collapse-sm collapse-xs';
    $collapseMd = 'collapse-md  collapse-sm collapse-xs';
    $tableElements = [
        'ID' => [
            'header' => [ 'text' => 'ID', 'classList' => $thClassList ],
            'cell' => [ 'classList' => $tdClassList, 'innerHtml' => "<a href='viewDef.php?defID=%s'>%s</a>" ]
        ],
        'location' => [
            'header' => [ 'text' => 'Location', 'classList' => "$thClassList $collapseSm" ],
            'cell' => [ 'classList' => "$tdClassList $collapseSm" ]
        ],
        'severity' => [
            'header' => [ 'text' => 'Severity', 'classList' => "$thClassList $collapseXs" ],
            'cell' => [ 'classList' => "$tdClassList $collapseXs" ]
        ],
        'dateCreated' => [
            'header' => [ 'text' => 'Date Created', 'classList' => "$thClassList $collapseMd" ],
            'cell' => [ 'classList' => "$tdClassList $collapseMd" ]
        ],
        'status' => [
            'header' => [ 'text' => 'Status', 'classList' => $thClassList ],
            'cell' => [ 'classList' => $tdClassList ]
        ],
        'systemAffected' => [
            'header' => [ 'text' => 'System Affected', 'classList' => "$thClassList $collapseSm" ],
            'cell' => [ 'classList' => "$tdClassList $collapseSm" ]
        ],
        'description' => [
            'header' => [ 'text' => 'Brief Description', 'classList' => $thClassList ],
            'cell' => [ 'classList' => $tdClassList ]
        ],
        'specLoc' => [
            'header' =>  [ 'text' => 'Specific Location', 'classList' => "$thClassList $collapseMd" ],
            'cell' => [ 'classList' => "$tdClassList $collapseMd" ]
        ],
        'lastUpdated' => [
            'header' => [ 'auth' => 20, 'text' => 'Last Updated', 'classList' => "$thClassList $collapseMd" ],
            'cell' => [ 'auth' => 20, 'classList' => "$tdClassList $collapseMd" ]
        ],
        'edit' => [
            'header' => ['auth' => 15, 'text' => 'Edit', 'classList' => "$thClassList $collapseSm" ],
            'cell' => [
                'auth' => 15,
                'classList' => "$tdClassList $collapseSm",
                'innerHtml' => "<a id='updateDef%s' href='updateDef.php?defID=%s' class='btn btn-outline'><i class='typcn typcn-edit'></i></button>"
            ]
        ]
    ];
    printDefsTable($result, $tableElements, $userLvl);
}

function printBartDefsTable($result, $role) {
    $thF = "<th class='%s'>%s</th>";
    $tdClassList = 'svbx-td';
    $thClassList = 'svbx-th';
    $collapseXs = 'collapse-xs';
    $collapseSm = 'collapse-sm collapse-xs';
    $collapseMd = 'collapse-md  collapse-sm collapse-xs';
    $tableElements = [
        'ID' => [
            'header' => [ 'text' => 'ID' ],
            'cell' => [ 'innerHtml' => "<a href='viewDef.php?bartDefID=%s'>%s</a>" ]
        ],
        'status' => [
            'header' => [ 'text' => 'Status' ],
            'cell' => []
        ],
        'date_created' => [
            'header' => [ 'text' => 'Date created' ],
            'cell' => []
        ],
        'descriptive_title_vta' => [
            'header' => [ 'text' => 'Description' ],
            'cell' => []
        ],
        'resolution_vta' => [
            'header' => [ 'text' => 'Resolution' ],
            'cell' => []
        ],
        'next_step' => [
            'header' => [ 'text' => 'Next step' ],
            'cell' => []
        ],
        'edit' => [
            'header' => [ 'text' => 'Edit', 'element' => sprintf($thF, "$thClassList $collapseSm", 'Edit')],
            'cell' => [
                'element' => sprintf("<td class='%s'><a id='updateDef%s'  href='updateBartDef.php?bartDefID=%s'><i class='typcn typcn-edit'></i></a></td>", "$thClassList $collapseSm", '%s', '%s'),
                'innerHtml' => "<a id='updateDef%s' href='updateBartDef.php?bartDefID=%s' class='btn btn-outline'><i class='typcn typcn-edit'></i></button></form>"
            ]
        ]
    ];

    printDefsTable($result, $tableElements, $role);
}

// check for search params
// if no search params show all defs that are not 'deleted'
if(!empty($_GET['search'])) {
    $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);
    $get = array_filter($get); // filter to remove falsey values -- is this necessary??
    unset($get['search']);
} else {
    $get = null;
}
    // render Project Defs table and Search Fields
    try {
        // printSearchBar($link, $get, ['method' => 'GET', 'action' => 'defs.php']);
    } catch (Exception $e) {
        echo "<h1 id='searchBarCatch' style='color: #fa0;'>print search bar got issues: {$e}</h1>";
    }

    // printInfoBox($role, 'NewDef.php');

    try {
        $fields = [
            "c.defID AS ID",
            "l.locationName AS location",
            "s.severityName AS severity",
            "DATE_FORMAT(c.dateCreated, '%d %b %Y') AS dateCreated",
            "t.statusName AS status",
            "y.systemName AS systemAffected",
            "SUBSTR(c.description, 1, 50) AS description",
            "c.specLoc AS specLoc",
            "c.lastUpdated AS lastUpdated"
        ];
        $joins = [
            "location l" => "c.location = l.locationID",
            "severity s" => "c.severity = s.severityID",
            "status t" => "c.status = t.statusID",
            "system y" => "c.systemAffected = y.systemID"
        ];
        foreach ($joins as $tableName => $on) {
            $link->join($tableName, $on, 'LEFT');
        }

        if ($get) {
            foreach ($get as $param => $val) {
                if ($param === 'description') $link->where($param, "%{$val}%", 'LIKE');
                else $link->where($param, $val);
            }
        }

        $link->orderBy('ID', 'ASC');
        $link->where('c.status', 'closed', '<>');
        
        $context['data'] = $result = $link->get("$table c", null, $fields);
        $template->display($context);
        // printProjectDefsTable($result, $_SESSION['role']);
    } catch (Twig_Error $e) {
        echo $e->getTemplateLine . ' ' . $e->getRawMessage();
    } catch (Exception $e) {
        echo $e->getMessage();
    }

$link->disconnect();

