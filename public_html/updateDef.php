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
    
    // get select options from lookup tables
    $selectOptions = Deficiency::getLookUpOptions();
    
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