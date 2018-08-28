<?php
include('session.php');
include('sqlFunctions.php');
include('html_components/defComponents.php');
include('html_functions/bootstrapGrid.php');
$Role = $_SESSION['role'];
$title = "SVBX - New Deficiency";
if ($Role <= 10) {
    header('Location: unauthorised.php');
}

// include('filestart.php');

// initialize twig
$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader,
    [
        'debug' => true
    ]
);
$twig->addExtension(new Twig_Extension_Debug());

$elements = $requiredElements + $optionalElements + $closureElements;

$requiredRows = [
    'Required Information',
    [
        'options' => [ 'inline' => true ],
        $elements['safetyCert'],
        $elements['systemAffected']
    ],
    [
        'options' => [ 'inline' => true ],
        $elements['location'],
        $elements['specLoc']
    ],
    [
        'options' => [ 'inline' => true ],
        $elements['status'],
        $elements['severity']
    ],
    [
        'options' => [ 'inline' => true ],
        $elements['dueDate'],
        $elements['groupToResolve']
    ],
    [
        'options' => [ 'inline' => true ],
        $elements['milestone'],
        $elements['contract']
    ],
    [
        'options' => [ 'inline' => true ],
        $elements['identifiedBy'],
        $elements['defType']
    ],
    [
        $elements['description']
    ]
];

$optionalRows = [
    'Optional Information',
    [
        'options' => [ 'inline' => true ],
        $elements['spec'],
        $elements['actionOwner']
    ],
    [
        'options' => [ 'inline' => true ],
        $elements['oldID'],
        $elements['def_pics']
    ],
    [
        $elements['defCommentText']
    ]
];

$closureRows = [
    'Closure Information',
    [
        'options' => [ 'inline' => true ],
        $elements['evidenceType'],
        $elements['documentRepo'],
        $elements['evidenceLink']
    ],
    [
        $elements['closureComments']
    ]
];

$twig->display('head.html.twig', ['title' => PROJECT_NAME . ' - Create new deficiency record']);

echo "<body>";

$twig->display('nav.html.twig', ['navbarHeading' => !empty($_SESSION['username'])
    ? (!empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
        ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
        : $_SESSION['username'])
    : '']);

echo "
    <header class='container page-header'>
        <h1 class='page-title'>Add New Deficiency</h1>
    </header>
    <main role='main' class='container main-content'>
        <form action='commit/RecDef.php' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='username' value='{$_SESSION['username']}' />";

        foreach ([$requiredRows, $optionalRows, $closureRows] as $rowGroup) {
            $rowName = array_shift($rowGroup);
            $content = iterateRows($rowGroup);
            printSection($rowName, $content);
        }

echo "
        <div class='center-content'>
            <button type='submit' value='submit' class='btn btn-primary btn-lg'>Submit</button>
            <button type='reset' value='reset' class='btn btn-primary btn-lg'>Reset</button>
        </div>
    </form>
</main>";

include('fileend.php');
?>
