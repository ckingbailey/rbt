<?php
require_once '../vendor/autoload.php';
require_once 'sqlFunctions.php';
require_once 'lookupQryFcns.php';

session_start();

// instantiate classes
$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader,
    array(
        'debug' => true
    )
);

//* DEFAULTS */
$context = array(
    'navbarHeading' => !empty($_SESSION['username'])
        ? ( !empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
            ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
            : $_SESSION['username'] )
        : '',
    'navHeadingLink' => '/account.php',
    'title' => 'Manage Data',
    'pageHeading' => 'List of lookup tables',
    'cardHeading' => '',
    'tableName' => '',
    'data' => [],
    'count' => 0
);

/* parse url to establish which view to display
** [0] => action of view, e.g., 'list', 'add'
** [1] => name of table to manage
*/
$pathinfo = !empty($_SERVER['PATH_INFO'])
    ? substr($_SERVER['PATH_INFO'], strpos($_SERVER['PATH_INFO'], '/') + 1)
    : '';
    
$pathParams = explode("/", $pathinfo);

// appropriately named file selects template and sql string
// otherwise use default
list($action, $tableName) = count($pathParams) >= 2
    ? [ $pathParams[0], $pathParams[1] ]
    : [ 'list', '' ];

$template = $twig->load("$action.html.twig");
$context['meta'] = $action;

// included sql file should perform the query and return table data
/* included file will also include relevant vars for display
** $title
** $pageHeading
** $cardHeading
** $tableName
** $data
** $count
*/

if (!empty($tableName)) {
    $displayName = !empty($displayNames[$tableName])
    ? $displayNames[$tableName]
    : $tableName;
    
    $context['meta'] = $tableName;
    $context['tableName'] = $tableName;
    $context['pageHeading'] = $context['title'] = ucfirst(
        $action === 'list'
            ? $action . ' of '. pluralize($displayName)
            : $action . ' ' . $displayName
    );
    $context['cardHeading'] = ucfirst(pluralize($displayName));
    $context['backto'] = $action === 'list'
        ? 'manage.php'
        : "manage.php/list/$tableName";

    try {
        $link = connect();
        $context = array_merge(
            $context,
            getLookupData($action, $tableName, $link)
        );
    } catch (Exception $e) {
        echo "<pre style='color: orangeRed'>There was a problem retrieving the data: $e</pre>";
    } finally {
        $link->disconnect();
    }
} else include '../inc/listAllLookups.php';

// then render the template with appropriate variables
/* !! navbar only has two possible states
**    should rely on the nav template for which state is shown
**    and pass it only a loggedIn/notLoggiedIn param
*/
$template->display($context);
