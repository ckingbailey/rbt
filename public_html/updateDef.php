<?php
$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/..';
require 'session.php';
require $baseDir . '/vendor/autoload.php';
// include('html_components/defComponents.php');
// include('html_functions/bootstrapGrid.php');
// include('sql_functions/stmtBindResultArray.php');

// $title = "SVBX - Update Deficiency";
$role = $_SESSION['role'];
$navbarHeading = $userFullName = !empty($_SESSION['username'])
  ? ( !empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
    ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
    : $_SESSION['username'] )
  : '';
$defID = filter_input(INPUT_GET, 'defID');

// prepare sql statement
// $fieldList = preg_replace('/\s+/', '', file_get_contents("$baseDir/inc/sql/updateDef.sql"));
// $fieldsArr = array_fill_keys(explode(',', $fieldList), '?');

// include('filestart.php');

if (!empty($_SESSION['errorMsg'])) {
    echo "
        <p style='font-family: monospace; color: red;'>{$_SESSION['errorMsg']}</p>";
    unset($_SESSION['errorMsg']);
}

try {
    $link = connect();
    
    $fields = [
        'safetyCert',
        'systemAffected',
        'location',
        'specLoc',
        'status',
        'severity',
        'dueDate',
        'groupToResolve',
        'milestone',
        'contract',
        'identifiedBy',
        'defType',
        'description',
        'spec',
        'actionOwner',
        'evidenceType',
        'documentRepo',
        'evidenceLink',
        'oldID',
        'closureComments',
        'createdBy',
        'dateCreated',
        'updatedBy',
        'lastUpdated',
        'dateClosed',
        'closureRequested',
        'closureRequestedBy'
    ];

    // get data about current deficiency
    $link->where('defID', $defID);
    $defData = $link->getOne('deficiency', $fields);
    
    // collect all select options
    $selectOptions = [];
    
    $selectOptions['safetyCert'] = $link->get('yesNo', null, ['yesNoID AS id', 'yesNoName AS name']);
    $selectOptions['systemAffected'] = $selectOptions['groupToResolve'] = $link->get('system', null, ['systemID AS id', 'systemName AS name']);
    $selectOptions['location'] = $link->get('location', null, ['locationID AS id', 'locationName AS name']);
    
    $link->where('statusName', 'deleted', '<>');
    $link->orWhere('statusName', 'archived', '<>');
    $selectOptions['status'] = $link->get('status', null, ['statusID AS id', 'statusName AS name']);
    $selectOptions['severity'] = $link->get('severity', null, ['severityID AS id', 'severityName AS name']);
    $selectOptions['milestone'] = $link->get('milestone', null, ['milestoneID AS id', 'milestoneName AS name']);
    $selectOptions['contract'] = $link->get('contract', null, ['contractID AS id', 'contractName AS name']);
    $selectOptions['defType'] = $link->get('defType', null, ['defTypeID AS defType', 'defTypeName AS name']);
    $selectOptions['evidenceType'] = $link->get('evidenceType', null, ['eviTypeID AS id', 'eviTypeName AS name']);
    $selectOptions['documentRepo'] = $link->get('documentRepo', null, ['docRepoID AS id', 'docRepoName AS name']);
    
    // $sql = "SELECT $fieldList FROM deficiency WHERE defID=?";

    // $elements = $requiredElements + $optionalElements + $closureElements;

    // if (!$stmt = $link->prepare($sql)) throw new mysqli_sql_exception($link->error);

    // if (!$stmt->bind_param('i', $defID)) throw new mysqli_sql_exception($stmt->error);

    // if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);

    // if (!stmtBindResultArrayRef($stmt, $elements))
    //     throw new mysqli_sql_exception($stmt->error);

    // $stmt->close();

    // $res = $link->query('select statusName from status where statusID = ' . $elements['status']['value']);
    // while ($row = $res->fetch_assoc()) {
    //     $defStatusName = $row['statusName'];
    // }
    // special options for Contractor level when Def is Open
    // if ($role === 15 && stripos($defStatusName, 'open') !== false) {
    //     $elements['status']['query'] = [ 1 => 'Open', 4 => 'Request closure' ];
    // }

    // query for comments associated with this Def
    // $sql = "SELECT firstname, lastname, dateCreated, defCommentText
    //     FROM def_comments c
    //     JOIN users u
    //     ON c.createdBy=u.userID
    //     WHERE c.defID=?
    //     ORDER BY c.dateCreated DESC";

    // if (!$stmt = $link->prepare($sql)) throw new mysqli_sql_exception($link->error);

    // if (!$stmt->bind_param('i', $defID)) throw new mysqli_sql_exception($stmt->error);

    // if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);

    // $comments = stmtBindResultArray($stmt) ?: [];

    // $stmt->close();

    // query for photos linked to this Def
    // if (!$stmt = $link->prepare("SELECT pathToFile FROM def_pics WHERE defID=?"))
    //     throw new mysqli_sql_exception($link->error);

    // if (!$stmt->bind_param('i', $defID))
    //     throw new mysqli_sql_exception($stmt->error);

    // if (!$stmt->execute())
    //     throw new mysqli_sql_exception($stmt->error);

    // if (!$stmt->store_result())
    //     throw new mysqli_sql_exception($stmt->error);

    // $photos = stmtBindResultArray($stmt);

    // $stmt->close();
    
    // check whether closure has been requested
    // if (!$stmt = $link->prepare("SELECT closureRequested, closureRequestedBy from deficiency where defID = ?"))
    //     throw new mysqli_sql_exception($link->error);
        
    // if (!$stmt->bind_param('i', $defID))
    //     throw new mysqli_sql_exception($stmt->error);

    // if (!$stmt->execute())
    //     throw new mysqli_sql_exception($stmt->error);

    // $closureRequested = stmtBindResultArray($stmt)[0]['closureRequested'];
        
    // $stmt->close();

    // toggle button for collapsible sections
    // $toggleBtn = '<a data-toggle=\'collapse\' href=\'#%1$s\' role=\'button\' aria-expanded=\'false\' aria-controls=\'%1$s\' class=\'collapsed\'>%2$s<i class=\'typcn typcn-arrow-sorted-down\'></i></a>';

    // $requiredRows = [
    //     [
    //         $elements['safetyCert'],
    //         $elements['systemAffected']
    //     ],
    //     [
    //         $elements['location'],
    //         $elements['specLoc']
    //     ],
    //     [
    //         $elements['status'],
    //         $elements['severity']
    //     ],
    //     [
    //         $elements['dueDate'],
    //         $elements['groupToResolve']
    //     ],
    //     [
    //         $elements['milestone'],
    //         $elements['contract']
    //     ],
    //     [
    //         $elements['identifiedBy'],
    //         $elements['defType']
    //     ],
    //     [
    //         $elements['description']
    //     ]
    // ];

    // $optionalRows = [
    //     [
    //         $elements['spec'],
    //         $elements['actionOwner']
    //     ],
    //     [
    //         $elements['oldID'],
    //         $elements['def_pics']
    //     ]
    // ];

    // $closureRows = [
    //     [
    //         $elements['evidenceType'],
    //         $elements['documentRepo'],
    //         $elements['evidenceLink']
    //     ],
    //     [
    //         $elements['closureComments']
    //     ]
    // ];
    
    // determine header background color
    // $color = (stripos($defStatusName, 'open') !== false ? "bg-red " : "bg-success ") . "text-white";

    // initialize twig
    $loader = new Twig_Loader_Filesystem("$baseDir/views");
    $twig = new Twig_Environment($loader);
    
    $twig->display('defForm.html.twig', [
        'title' => "Update def #$defID",
        'navbarHeading' => $userFullName,
        'pageHeading' => "Update deficiency $defID",
        'selectOptions' => [],
        'defData' => $defData,
        'footerText' => "[placeholder]",
        'copyrightText' => "[copyrightPlaceholder]"
    ]);
    
//     $twig->display('head.html.twig', [ 'title' => PROJECT_NAME . ' - Update deficiency #' . $defID ]);
//     echo "<body>";
//     $twig->display('nav.html.twig', [ 'navbarHeading' => $navbarHeading ]);
//     echo "
//         <header class='container page-header'>
//             <h1 class='page-title $color pad'>Update Deficiency ".$defID."</h1>";
//             if (!empty($closureRequested)) {
//                 echo "<h4 class='bg-yellow text-light pad-less'>Closure requested</h4>";
//             }
//     echo "
//         </header>
//         <main class='container main-content'>
//         <form action='commit/updateDefCommit.php' method='POST' enctype='multipart/form-data' onsubmit='' class='item-margin-bottom'>
//             <input type='hidden' name='defID' value='$defID'>
//             <div class='row'>
//                 <div class='col-12'>
//                     <h4 class='pad grey-bg'>Deficiency No. $defID</h4>
//                 </div>
//             </div>";

//             foreach ($requiredRows as $gridRow) {
//                 $options = [ 'required' => true ];
//                 if (count($gridRow) > 1) $options['inline'] = true;
//                 else $options['colWd'] = 6;
//                 print returnRow($gridRow, $options);
//             }

//         echo "
//             <h5 class='grey-bg pad'>
//                 <a data-toggle='collapse' href='#optionalInfo' role='button' aria-expanded='false' aria-controls='optionalInfo' class='collapsed'>Optional Information<i class='typcn typcn-arrow-sorted-down'></i></a>
//             </h5>
//             <div id='optionalInfo' class='collapse item-margin-bottom'>";
//             foreach ($optionalRows as $gridRow) {
//                 $options = [ 'required' => true ];
//                 if (count($gridRow) > 1) $options['inline'] = true;
//                 else $options['colWd'] = 6;
//                 print returnRow($gridRow, $options);
//             }
//         echo "
//                 <p class='text-center pad-less bg-yellow'>Photos uploaded from your phone may not preserve rotation information. We are working on a fix for this.</p>
//             </div>
//             <h5 class='grey-bg pad'>
//                 <a data-toggle='collapse' href='#closureInfo' role='button' aria-expanded='false' aria-controls='closureInfo' class='collapsed'>Closure Information<i class='typcn typcn-arrow-sorted-down'></i></a>
//             </h5>
//             <div id='closureInfo' class='collapse item-margin-bottom'>";
//             foreach ($closureRows as $gridRow) {
//                 $options = [ 'required' => true ];
//                 if (count($gridRow) > 1) $options['inline'] = true;
//                 else $options['colWd'] = 6;
//                 print returnRow($gridRow, $options);
//             }
//         echo "
//             </div>
//             <h5 class='grey-bg pad'>";
//         printf($toggleBtn, 'comments', 'Comments');
//         echo "
//             </h5>
//             <div id='comments' class='collapse item-margin-bottom'>";
//         echo returnRow([ $optionalElements['defCommentText'] ], [ 'colWd' => 8 ]);
//             foreach ($comments as $comment) {
//                 $commenterFullName = $comment['firstname'].' '.$comment['lastname'];
//                 $text = stripcslashes($comment['defCommentText']);
//                 printf($commentFormat, $commenterFullName, $comment['dateCreated'], $text);
//             }
//         echo "</div>";

//         if (count($photos)) {
//             print returnCollapseSection(
//                 'Photos',
//                 'defPics',
//                 returnPhotoSection(
//                     $photos,
//                     "<img src='%s' alt='photo related to deficiency number {$defID}'>"
//                 ),
//                 'item-margin-bottom'
//             );
//         }

//             echo "
//                 <div class='row item-margin-bottom'>
//                     <div class='col-12 center-content'>";
//                     // if Def is not Closed, show submit btn
//                     // if Def is Closed, show "Re-open" btn
//                     if (stripos($defStatusName, 'open') !== false) {
//                         echo "
//                             <button type='submit' class='btn btn-primary btn-lg'>Submit</button>
//                             <button type='reset' class='btn btn-primary btn-lg'>Reset</button>";
//                     } else {
//                         echo "
//                             <button type='button' onclick='return reopenDef(event)'>Re-open Deficiency</button>";
//                     }
//             echo "
//                     </div>
//                 </div>
//             </form>";
//     if ($role >= 40) {
//         echo "
//             <form action='DeleteDef.php' method='POST' onsubmit=''>
//                 <div class='row'>
//                     <div class='col-12 center-content'>
//                         <button class='btn btn-danger btn-lg' type='submit' name='q' value='$defID'
//                             onclick='return confirm(`ARE YOU SURE? Deficiencies should not be deleted, your deletion will be logged.`)'>delete</button>
//                     </div>
//                 </div>
//             </form>";
//     }
//     echo "</main>";
//     echo "
//         <script>
//             function reopenDef(ev) {
//                 const form = document.forms[0];
//                 document.forms[0].status.value = 1;
//                 forms.submit();
//             }
//         </script>";
} catch (Exception $e) {
    print "Unable to retrieve record: {$e->getMessage()}";
    exit;
} finally {
    $link->close();
    include('fileend.php');
}
