<?PHP
session_start();
$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/..';
include('sqlFunctions.php');
include('uploadImg.php');
$updateDefSql = file_get_contents("$baseDir/inc/sql/updateDef.sql");

$date = date('Y-m-d');
$userID = intval($_SESSION['userID']);
$username = $_SESSION['username'];
$nullVal = null;

$link = f_sqlConnect();

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

        
// prepare POST and sql string for commit
$post = array(
  'safetyCert' => intval($_POST['safetyCert']),
  'systemAffected' => intval($_POST['systemAffected']),
  'location' => intval($_POST['location']),
  'specLoc' => filter_var($link->escape_string($_POST['specLoc']), FILTER_SANITIZE_STRING),
  'status' => intval($_POST['status']),
  'severity' => intval($_POST['severity']),
  'dueDate' => filter_var($link->escape_string($_POST['dueDate']), FILTER_SANITIZE_STRING),
  'groupToResolve' => intval($_POST['groupToResolve']),
  'milestone' => intval($_POST['milestone']),
  'contract' => intval($_POST['contract']),
  'identifiedBy' => filter_var($link->escape_string($_POST['identifiedBy']), FILTER_SANITIZE_STRING),
  'defType' => intval($_POST['defType']),
  'description' => filter_var($link->escape_string($_POST['description']), FILTER_SANITIZE_STRING),
  'spec' => filter_var($link->escape_string($_POST['spec']), FILTER_SANITIZE_STRING),
  'actionOwner' => filter_var($link->escape_string($_POST['actionOwner']), FILTER_SANITIZE_STRING),
  'evidenceType' => filter_var($_POST['evidenceType'], FILTER_SANITIZE_NUMBER_INT) ?: null,
  'documentRepo' => filter_var($_POST['documentRepo'], FILTER_SANITIZE_NUMBER_INT) ?: null,
  'evidenceLink' => filter_var($link->escape_string($_POST['evidenceLink']), FILTER_SANITIZE_STRING),
  'oldID' => filter_var($link->escape_string($_POST['oldID']), FILTER_SANITIZE_SPECIAL_CHARS),
  'closureComments' => filter_var($link->escape_string($_POST['closureComments']), FILTER_SANITIZE_STRING),
  'createdBy' => $userID,
  'dateCreated' => $date,
  'dateClosed' => $nullVal
);

// validate POST data
// if it's empty then file upload exceeds post_max_size
// bump user back to form
if (!count($post)) {
    include('js/emptyPostRedirect.php');
    exit;
}

// if photo in POST it will be committed to a separate table
if ($_FILES['def_pics']['size']
    && $_FILES['def_pics']['name']
    && $_FILES['def_pics']['tmp_name']
    && $_FILES['def_pics']['type']) {
    $def_pics = $_FILES['def_pics'];
} else $def_pics = null;

// hold onto comments separately
$defCommentText = trim($_POST['defCommentText']);
    
// prepare parameterized string from external .sql file
$fieldList = preg_replace('/\s+/', '', $updateDefSql);
$fieldsArr = array_fill_keys(explode(',', $fieldList), '?');

// unset keys that will not be updated before imploding back to string
unset(
    $fieldsArr['defID'],
    $fieldsArr['updated_by'],
    $fieldsArr['lastUpdated']
);

$assignmentList = implode(' = ?, ', array_keys($fieldsArr)).' = ?';
$sql = 'INSERT INTO deficiency ('
  . implode(', ', array_keys($post))
  . ') VALUES ('
  . implode(',', array_fill(0, count($post), '?'))
  . ')';

// if photo in POST it will be committed to a separate table
if ($_FILES['def_pics']['size']
    && $_FILES['def_pics']['name']
    && $_FILES['def_pics']['tmp_name']
    && $_FILES['def_pics']['type']) {
    $def_pics = $_FILES['def_pics'];
} else $def_pics = null;

try {
    $linkBtn = "<a href='updateDef.php?defID=%s' style='text-decoration: none; border: 2px solid plum; padding: .35rem;'>Back to Update Def</a>";
    
    if (!$stmt = $link->prepare($sql)) throw new Exception($link->error);
    
    $types = 'iiisiisiiisissssiisssss';
    
    if (!$stmt->bind_param('iiisiisiiisissssiisssss',
        $post['safetyCert'],
        $post['systemAffected'],
        $post['location'],
        $post['specLoc'],
        $post['status'],
        $post['severity'],
        $post['dueDate'],
        $post['groupToResolve'],
        $post['milestone'],
        $post['contract'],
        $post['identifiedBy'],
        $post['defType'],
        $post['description'],
        $post['spec'],
        $post['actionOwner'],
        $post['evidenceType'],
        $post['documentRepo'],
        $post['evidenceLink'],
        $post['oldID'],
        $post['closureComments'],
        $post['created_by'],
        $post['dateCreated'],
        $nullVal
    )) throw new mysqli_sql_exception($stmt->error);
    
    if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
    
    $defID = intval($stmt->insert_id);
    
    $stmt->close();
    
    // if INSERT succesful, prepare, upload, and INSERT photo
    if ($def_pics) {
        $sql = "INSERT def_pics (defID, pathToFile, uploadedBy) values (?, ?, ?)";
        
        $pathToFile = $link->escape_string(saveImgToServer($_FILES['def_pics'], $defID));
        if ($pathToFile) {
            if (!$stmt = $link->prepare($sql)) throw new Exception($link->error);
            
            if (!$stmt->bind_param('isi', $defID, $pathToFile, $userID)) throw new mysqli_sql_exception($stmt->error);
            
            if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
            
            $stmt->close();
        }
    }
    
    // if comment submitted commit it to a separate table
    if (!empty($defCommentText)) {
        $sql = "INSERT def_comments (defID, defCommentText, dateCreated, createdBy) VALUES (?, ?, NOW(), ?)";
        $commentText = filter_var($defCommentText, FILTER_SANITIZE_SPECIAL_CHARS);
        $commentText = $link->escape_string($commentText);
        if (!$stmt = $link->prepare($sql)) throw new Exception($link->error);
        if (!$stmt->bind_param('isi',
            $defID,
            $commentText,
            $userID)) throw new mysqli_sql_exception($stmt->error);
        if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
        $stmt->close();
    }

    header("Location: /viewDef.php?defID=$defID");
} catch (Exception $e) {
    echo "There was an error in committing your submission: " . $e->getMessage();
} finally {
    $link->close();
    exit;
}
