<?php
$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/..';
require 'session.php';
require $baseDir . '/vendor/autoload.php';
$role = $_SESSION['role'];

$navbarHeading = $userFullName = !empty($_SESSION['username'])
  ? ( !empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
    ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
    : $_SESSION['username'] )
  : '';
$defID = filter_input(INPUT_GET, 'defID');
// $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);


// if POST data rec'd, process it before rendering form
if (!empty($_POST) && !empty($_POST['defID'])) {
    $updateDef = new Deficiency($_POST);
    $_POST = [];
    
    echo "<pre id='updateDef' style='margin-top: 1rem; margin-left: 1rem; color: blue'>";
    echo $updateDef;
    echo "</pre>";
    exit;
} else {

try {
    $link = connect();
    
    $fields = [
        'defID',
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
    $defData['description'] = html_entity_decode($defData['description'], ENT_QUOTES|ENT_HTML5, 'UTF-8');
    
    // collect all select options from lookup tables
    $selectOptions = Deficiency::getLookUpOptions();
    
    // $selectOptions['safetyCert'] = $link->get('yesNo', null, ['yesNoID AS id', 'yesNoName AS name']);
    // $selectOptions['systemAffected'] = $selectOptions['groupToResolve'] = $link->get('system', null, ['systemID AS id', 'systemName AS name']);
    // $selectOptions['location'] = $link->get('location', null, ['locationID AS id', 'locationName AS name']);
    
    // $link->where('statusName', 'deleted', '<>');
    // $link->orWhere('statusName', 'archived', '<>');
    // $selectOptions['status'] = $link->get('status', null, ['statusID AS id', 'statusName AS name']);
    // $selectOptions['severity'] = $link->get('severity', null, ['severityID AS id', 'severityName AS name']);
    // $selectOptions['milestone'] = $link->get('milestone', null, ['milestoneID AS id', 'milestoneName AS name']);
    // $selectOptions['contract'] = $link->get('contract', null, ['contractID AS id', 'contractName AS name']);
    // $selectOptions['defType'] = $link->get('defType', null, ['defTypeID AS id', 'defTypeName AS name']);
    // $selectOptions['evidenceType'] = $link->get('evidenceType', null, ['eviTypeID AS id', 'eviTypeName AS name']);
    // $selectOptions['documentRepo'] = $link->get('documentRepo', null, ['docRepoID AS id', 'docRepoName AS name']);
    
    // get asset list for def_asset_link
    $assetList = $link->get('asset', null, ['assetID AS id', 'assetTag']);
    
    // initialize twig
    $loader = new Twig_Loader_Filesystem("$baseDir/templates");
    $twig = new Twig_Environment($loader, [ 'debug' => true ]);
    $twig->addExtension(new Twig_Extension_Debug());
    
    $twig->display('defForm.html.twig', [
        'title' => PROJECT_NAME . " - Update def #$defID",
        'navbarHeading' => $userFullName,
        'pageHeading' => "Update deficiency $defID",
        'formAction' => $_SERVER['PHP_SELF'],
        'onSubmit' => '',
        'selectOptions' => $selectOptions,
        'defData' => $defData,
        'assetList' => $assetList,
        'footerText' => "[placeholder]",
        'copyrightText' => "[copyrightPlaceholder]"
    ]);
    
} catch (Exception $e) {
    print "Unable to retrieve record: {$e->getMessage()}";
} finally {
    if (is_a($link, 'MysqliDb')) $link->disconnect();
}
}