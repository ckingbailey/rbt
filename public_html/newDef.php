<?php
$baseDir = __DIR__ . '/..';
require 'session.php';
require $baseDir . '/vendor/autoload.php';
// include('sqlFunctions.php');
// include('html_components/defComponents.php');
// include('html_functions/bootstrapGrid.php');
$role = $_SESSION['role'];
$navbarHeading = $userFullName = !empty($_SESSION['username'])
  ? ( !empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
    ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
    : $_SESSION['username'] )
  : '';
// $title = "SVBX - New Deficiency";
if ($role <= 10) {
    header('Location: unauthorised.php');
    exit;
}

if (!empty($_POST)) {
    // require 'commit/RecDef.php';
    $newDef = new Deficiency($_POST);
    $_POST = [];

    $defID = $newDef->insert();
    
    if ($defID) {
        header("Location: /viewDef.php?defID=$defID");
        exit;
    }
}
// initialize twig
$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader,
    [
        'debug' => $_ENV['PHP_ENV'] === 'dev' ? true : false
    ]
);
if ($_ENV['PHP_ENV'] === 'dev') {
    $twig->addExtension(new Twig_Extension_Debug());
}

try {
    $link = connect();
    
    // collect all select options from lookup tables
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
    $selectOptions['defType'] = $link->get('defType', null, ['defTypeID AS id', 'defTypeName AS name']);
    $selectOptions['evidenceType'] = $link->get('evidenceType', null, ['eviTypeID AS id', 'eviTypeName AS name']);
    $selectOptions['documentRepo'] = $link->get('documentRepo', null, ['docRepoID AS id', 'docRepoName AS name']);
    
    // get asset list for def_asset_link
    $assetList = $link->get('asset', null, ['assetID AS id', 'assetTag']);
    
    // initialize twig
    $loader = new Twig_Loader_Filesystem("$baseDir/templates");
    $twig = new Twig_Environment($loader, [ 'debug' => true ]);
    $twig->addExtension(new Twig_Extension_Debug());
    
    $twig->display('defForm.html.twig', [
        'title' => PROJECT_NAME . " - Add def",
        'navbarHeading' => $userFullName,
        'pageHeading' => "Record new deficiency",
        'formAction' => $_SERVER['PHP_SELF'],
        'onSubmit' => '',
        'selectOptions' => $selectOptions,
        'defData' => null,
        'assetList' => $assetList,
        'footerText' => "[placeholder]",
        'copyrightText' => "[copyrightPlaceholder]"
    ]);
    
} catch (Exception $e) {
    print "Unable to retrieve record: {$e->getMessage()}";
} finally {
    if (is_a($link, 'MysqliDb')) $link->disconnect();
}

// $elements = $requiredElements + $optionalElements + $closureElements;

// $requiredRows = [
//     'Required Information',
//     [
//         'options' => [ 'inline' => true ],
//         $elements['safetyCert'],
//         $elements['systemAffected']
//     ],
//     [
//         'options' => [ 'inline' => true ],
//         $elements['location'],
//         $elements['specLoc']
//     ],
//     [
//         'options' => [ 'inline' => true ],
//         $elements['status'],
//         $elements['severity']
//     ],
//     [
//         'options' => [ 'inline' => true ],
//         $elements['dueDate'],
//         $elements['groupToResolve']
//     ],
//     [
//         'options' => [ 'inline' => true ],
//         $elements['milestone'],
//         $elements['contract']
//     ],
//     [
//         'options' => [ 'inline' => true ],
//         $elements['identifiedBy'],
//         $elements['defType']
//     ],
//     [
//         $elements['description']
//     ]
// ];

// $optionalRows = [
//     'Optional Information',
//     [
//         'options' => [ 'inline' => true ],
//         $elements['spec'],
//         $elements['actionOwner']
//     ],
//     [
//         'options' => [ 'inline' => true ],
//         $elements['oldID'],
//         $elements['def_pics']
//     ],
//     [
//         $elements['defCommentText']
//     ]
// ];

// $closureRows = [
//     'Closure Information',
//     [
//         'options' => [ 'inline' => true ],
//         $elements['evidenceType'],
//         $elements['documentRepo'],
//         $elements['evidenceLink']
//     ],
//     [
//         $elements['closureComments']
//     ]
// ];

// $twig->display('head.html.twig', ['title' => PROJECT_NAME . ' - Create new deficiency record']);

// echo "<body>";

// $twig->display('nav.html.twig', ['navbarHeading' => !empty($_SESSION['username'])
//     ? (!empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
//         ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
//         : $_SESSION['username'])
//     : '']);

// echo "
//     <header class='container page-header'>
//         <h1 class='page-title'>Add New Deficiency</h1>
//     </header>
//     <main role='main' class='container main-content'>
//         <form action='commit/RecDef.php' method='POST' enctype='multipart/form-data'>
//             <input type='hidden' name='username' value='{$_SESSION['username']}' />";

//         foreach ([$requiredRows, $optionalRows, $closureRows] as $rowGroup) {
//             $rowName = array_shift($rowGroup);
//             $content = iterateRows($rowGroup);
//             printSection($rowName, $content);
//         }

// echo "
//         <div class='center-content'>
//             <button type='submit' value='submit' class='btn btn-primary btn-lg'>Submit</button>
//             <button type='reset' value='reset' class='btn btn-primary btn-lg'>Reset</button>
//         </div>
//     </form>
// </main>";

// include('fileend.php');
