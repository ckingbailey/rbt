<?php
session_start();
include('SQLFunctions.php');
include('uploadImg.php');

$link = f_sqlConnect();

// prepare POST and sql string for commit
$post = $_POST;
$defID = $post['defID'];
$userID = $_SESSION['UserID'];
$username = $_SESSION['Username'];

// validate POST data
// if it's empty then file upload exceeds post_max_size
// bump user back to form
if (!count($post) || !$defID) {
    include('js/emptyPostRedirect.php');
    exit;
}

// if photo in POST it will be committed to a separate table
if ($_FILES['CDL_pics']['size']
    && $_FILES['CDL_pics']['name']
    && $_FILES['CDL_pics']['tmp_name']
    && $_FILES['CDL_pics']['type']) {
    $CDL_pics = $_FILES['CDL_pics'];
} else $CDL_pics = null;
    
// hold onto comments separately
$cdlCommText = trim($post['cdlCommText']);

// prepare parameterized string from external .sql file
$fieldList = preg_replace('/\s+/', '', file_get_contents('UpdateDef.sql'));
$fieldsArr = array_fill_keys(explode(',', $fieldList), '?');

// unset keys that will not be updated before imploding back to string
unset(
    $fieldsArr['defID'],
    $fieldsArr['created_by'],
    $fieldsArr['dateCreated'],
    $fieldsArr['lastUpdated'],
    $fieldsArr['dateClosed']
);

$assignmentList = implode(' = ?, ', array_keys($fieldsArr)).' = ?';
$sql = "UPDATE CDL SET $assignmentList WHERE defID=$defID";

// append keys that do not or may not come from html form
// or whose values may be ambiguous in $_POST (e.g., checkboxes)
$post += ['updated_by' => $username];

try {
    $success = "<div style='background-color: pink; background-clip: padding-box; border: 5px dashed limeGreen;'>%s</div>";
    $successFormat = "<p style='color: %s'>%s</p>";
    $linkBtn = "<a href='UpdateDef.php?defID=%s' style='text-decoration: none; border: 2px solid plum; padding: .35rem;'>Back to Update Def</a>";
    
    if (!$stmt = $link->prepare($sql)) throw new Exception($link->error);
    
    $success = sprintf($success, sprintf($successFormat, 'blue', '&#x2714; CDL stmt prepared') . '%s');
    
    $types = 'iiisiisiiisissssiisss';
    if (!$stmt->bind_param($types,
        intval($post['safetyCert']),
        intval($post['systemAffected']),
        intval($post['location']),
        filter_var($link->escape_string($post['specLoc']), FILTER_SANITIZE_STRING),
        intval($post['status']),
        intval($post['severity']),
        filter_var($link->escape_string($post['dueDate']), FILTER_SANITIZE_STRING),
        intval($post['groupToResolve']),
        intval($post['requiredBy']),
        intval($post['contractID']),
        filter_var($link->escape_string($post['identifiedBy']), FILTER_SANITIZE_STRING),
        intval($post['defType']),
        filter_var($link->escape_string($post['description']), FILTER_SANITIZE_STRING),
        filter_var($link->escape_string($post['spec']), FILTER_SANITIZE_STRING),
        filter_var($link->escape_string($post['actionOwner']), FILTER_SANITIZE_STRING),
        filter_var($link->escape_string($post['oldID']), FILTER_SANITIZE_STRING),
        intval($post['evidenceType']),
        intval($post['repo']),
        filter_var($link->escape_string($post['evidenceLink']), FILTER_SANITIZE_STRING),
        filter_var($link->escape_string($post['closureComments']), FILTER_SANITIZE_STRING),
        filter_var($link->escape_string($post['updated_by']), FILTER_SANITIZE_STRING)
    )) throw new mysqli_sql_exception($stmt->error);
    
    $success= sprintf($success, sprintf($successFormat, 'forestGreen', '&#x2714; CDL params bound') . '%s');
    
    if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
    
    $success = sprintf($success, sprintf($successFormat, 'dodgerBlue', '&#x2714; CDL insert executed') . '%s');
    
    $stmt->close();
    
    $success = sprintf($success, sprintf($successFormat, 'indigo', '&#x2714; CDL stmt closed') . '%s');
    
    // if INSERT succesful, prepare, upload, and INSERT photo
    if ($CDL_pics) {
        $sql = "INSERT CDL_pics (defID, pathToFile) values (?, ?)";
        
        // execute save image and hold onto its new file path
        $pathToFile = $link->escape_string(saveImgToServer($_FILES['CDL_pics'], $defID));
        if ($pathToFile) {
            if (!$stmt = $link->prepare($sql)) throw new Exception($link->error);
            $success = sprintf($success, sprintf($successFormat, 'cadetBlue', '&#x2714; cdlPics stmt prepared') . '%s');
            
            if (!$stmt->bind_param('is', $defID, $pathToFile)) throw new mysqli_sql_exception($stmt->error);
            $success = sprintf($success, sprintf($successFormat, 'cornFlower', '&#x2714; cdlPics params bound') . '%s');
            
            if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
            $success = sprintf($success, sprintf($successFormat, 'aqua', '&#x2714; cdlPics insert executed') . '%s');
            
            $stmt->close();
            
            $success = sprintf($success, sprintf($successFormat, 'aquamarine', '&#x2714; cdlPics stmt closed') . '%s');
        }
    } else {
        $success = sprintf($success, sprintf($successFormat, 'cyan', '&#x2718; no cdlPics found') . '%s');
    }
    
    // if comment submitted commit it to a separate table
    if (strlen($cdlCommText)) {
        $sql = "INSERT cdlComments (defID, cdlCommText, userID) VALUES (?, ?, ?)";
        $commentText = filter_var(
            filter_var(
                $cdlCommText,
                FILTER_SANITIZE_STRING,
                FILTER_FLAG_NO_ENCODE_QUOTES
            ), FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$stmt = $link->prepare($sql)) throw new Exception($link->error);
        $success = sprintf($success, sprintf($successFormat, 'darkCyan', '&#x2714; cdlComments stmt prepared') . '%s');
        if (!$stmt->bind_param('isi',
            intval($defID),
            $commentText,
            intval($userID))) throw new mysqli_sql_exception($stmt->error);
        $success = sprintf($success, sprintf($successFormat, 'darkBlue', '&#x2714; cdlComments params bound') . '%s');
        if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
        $success = sprintf($success, sprintf($successFormat, 'darkTurquoise', '&#x2714; cdlComments stmt executed') . '%s');
        $stmt->close();
        $success = sprintf($success, sprintf($successFormat, 'deepSkyBlue', '&#x2714; cdlComments stmt closed') . '%s');
    } else {
        $success = sprintf($success, sprintf($successFormat, 'mediumAquamarine', '&#x2718; no cdlComments found') . '%s');
    }

    $link->close();
    
    $success = sprintf($success, sprintf($successFormat, 'lightSteelBlue', '&#x2714; link closed') . '%s');
    $success = sprintf($success, sprintf($linkBtn, $defID));
    print $success;
    
    header("Location: ViewDef.php?defID=$defID");
} catch (Exception $e) {
    print "There was an error in committing your submission";
    $link->close();
    exit;
}
?>