<?php
use codeguy\Upload\Exception;
require 'vendor/autoload.php';

session_start();
include('SQLFunctions.php');
include('error_handling/sqlErrors.php');
include('uploadAttachment.php');
$link = f_sqlConnect();

$date = date('Y-m-d');
$userID = $_SESSION['UserID'];

function printException(\Exception $exc, $color = 'orangeRed') {
    print "
        <div style='font-family: monospace'>
            <h4>Caught exception:</h4>
            <h2 style='color: $color'>".$exc->getCode().": ".$exc->getMessage()."</h2>
            <h3>".$exc->getFile().": ".$exc->getLine()."</h3>
            <h4>$line</h4>
        </div>";
}

// prepare POST and sql string for commit
$post = $_POST;
$bdCommText = $post['bdCommText'];

// validate POST data, if it's empty bump user back to form
if (!count($post)) {
    include('js/emptyPostRedirect.php');
    exit;
}

// check for attachment and prepare Upload object
if ($_FILES['attachment']['size']
    && $_FILES['attachment']['name']
    && $_FILES['attachment']['tmp_name']
    && $_FILES['attachment']['type']) {
    $folder = 'uploads/bartdlUploads';
    $attachmentKey = 'attachment';
}
$fieldList = preg_replace('/\s+/', '', file_get_contents('bartdl.sql')) . ',date_created';
$fieldsArr = array_fill_keys(explode(',', $fieldList), '?');
// unset keys that will not be INSERT'd
unset($fieldsArr['id']);
$fieldList = implode(',', array_keys($fieldsArr));
$sql = 'INSERT INTO BARTDL ('.implode(', ', array_keys($fieldsArr)).') VALUES ('.implode(', ', array_values($fieldsArr)).')';

try {
    if (!$stmt = $link->prepare($sql)) throw new Exception($link->error);
} catch (Exception $e) {
    printException($e);
}

try {
    $types = 'iiiiiisssiiiiisssssssss';
    if (!$stmt->bind_param($types,
        intval($post['created_by']),
        intval($post['created_by']),
        intval($post['creator']),
        intval($post['next_step']),
        intval($post['bic']),
        intval($post['status']),
        $link->escape_string($post['descriptive_title_vta']),
        $link->escape_string($post['root_prob_vta']),
        $link->escape_string($post['resolution_vta']),
        intval($post['priority_vta']),
        intval($post['agree_vta']),
        intval($post['safety_cert_vta']),
        intval($post['resolution_disputed']),
        intval($post['structural']),
        $link->escape_string($post['id_bart']),
        $link->escape_string($post['description_bart']),
        $link->escape_string($post['cat1_bart']),
        $link->escape_string($post['cat2_bart']),
        $link->escape_string($post['cat3_bart']),
        $link->escape_string($post['level_bart']),
        $link->escape_string($post['dateOpen_bart']),
        $link->escape_string($post['dateClose_bart']),
        $date
    )) throw new mysqli_sql_exception($stmt->error);

    if (!$stmt->execute()) {
        throw new mysqli_sql_exception($stmt->error);
    }
    $defID = $stmt->insert_id;
    $stmt->close();

    $location = "ViewDef.php?bartDefID=$defID";

    // insert comment if one was submitted
    if ($bdCommText) {
        $sql = "INSERT bartdlComments (bdCommText, userID, bartdlID) VALUES (?, ?, ?)";
        $types = 'sii';
        if (!$stmt = $link->prepare($sql)) {
            http_response_code(500);
            throw new mysqli_sql_exception($link->error);
        }
        if (!$stmt->bind_param($types,
            $link->escape_string($bdCommText),
            intval($userID),
            intval($defID))) {
                http_response_code(500);
                throw new mysqli_sql_exception($stmt->error);
        }
        if (!$stmt->execute()) {
            http_response_code(500);
            throw new mysqli_sql_exception($stmt->error);
        }
        $stmt->close();
    }
        
    // upload and insert attachment if found    
    if ($attachmentKey) uploadAttachment($link, $attachmentKey, $folder, $defID);
} catch (\mysqli_sql_exception $e) {
    $location = '';
    if (strpos($e->getMessage(), 'Duplicate entry') == false) {
        $msg = $link->escape_string($e->getMessage());
        print "
            <script>
                (function () {
                    window.history.go(-1);
                    window.alert('$msg')
                })();
            </script>";
        $link->close();
        exit;
    } else {
        printException($e);
        $link->close();
        exit;
    }
} catch (UploadException $e) {
    $location = '';
    printException($e);
    $link->close();
    exit;
} catch (\Exception $e) {
    $location = '';
    printException($e);
    $link->close();
    exit;
}

$link->close();

if ($location) {
    header("Location:$location");
} else {
    print "
        <p><a href='DisplayDefs.php?view=BART'>back to DisplayDefs</a></p>
        <p><a href='newBartDef.php'>back to newBartDef</a></p>";
}
exit();
