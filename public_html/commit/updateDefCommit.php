<?php
use Mailgun\Mailgun;

$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/..';
require $baseDir . '/vendor/autoload.php';
require 'sql_functions/sqlFunctions.php';
require 'uploadImg.php';
require 'session.php';

// prepare POST and sql string for commit
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
$defID = $post['defID'];
$userID = $_SESSION['userID'];
$role = $_SESSION['role'];

// if empty strings in $post, set them to null
foreach ($post as $field => $val) {
    if (empty($val)) $post[$field] = null;
}

// validate POST data
// if it's empty then file upload exceeds post_max_size
// bump user back to form
if (!count($post) || !$defID) {
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
$defCommentText = trim($post['defCommentText']);

// unset keys that will not be updated before imploding back to string
unset(
    $post['defID'],
    $post['defCommentText']
);

// if Closed, set dateClosed
// if Closure Requested, record by whom
if ($post['status'] === '2') {
    $post['dateClosed'] = 'NOW()';
} elseif ($post['status'] === '1') {
    $closureReq = $post['closureRequested'] = 0;
    $closeReqBy = $post['closureRequestedBy'] = null;
} elseif ($post['status'] === '4') {
    $post['status'] = 1;
    $closureReq = $post['closureRequested'] = 1;
    $post['closureRequestedBy'] = $_SESSION['userid'];
    $closeReqBy = $_SESSION['firstname'].' '.$_SESSION['lastname'];
}

// append keys that do not or may not come from html form
// or whose values may be ambiguous in $_POST (e.g., checkboxes)
$post['updatedBy'] = $userID;

try {
    $link = connect();
    // update deficiency table
    $link->where('defID', $defID);
    $link->update('deficiency', $post);

    // if INSERT succesful, prepare, upload, and INSERT photo
    if ($def_pics) {
        // $sql = "INSERT def_pics (defID, pathToFile) values (?, ?)";

        // execute save image and hold onto its new file path
        try {
            $pathToFile = saveImgToServer($_FILES['def_pics'], $defID);

            $fileData = [
                'pathToFile' => $pathToFile,
                'uploadedBy' => $userID,
                'defID' => $defID
            ];

            $link->insert('def_pics', $fileData);
        } catch (uploadException $e) {
            header("Location: updateDef.php?defID=$defID");
            $_SESSION['errorMsg'] = "There was an error uploading your file: $e";
        } catch (Exception $e) {
            header("Location: updateDef.php?defID=$defID");
            $_SESSION['errorMsg'] = "There was a problem recording your file: $e";
        }
    }

    // if comment submitted commit it to a separate table
    if (!empty($defCommentText)) {
        $commentData = [
            'defID' => $defID,
            'defCommentText' => filter_var($defCommentText, FILTER_SANITIZE_SPECIAL_CHARS),
            'dateCreated' => date('Y-m-d H:i:s'),
            'createdBy' => $userID
        ];

        $link->insert('def_comments', $commentData);
    }
    
    // if closure requested, try to email system lead    
    if (!empty($closureReq)) {
        // instantiate new mailgun client
        $mgClient = new Mailgun($mailgunKey);
        $domain = $mailgunDomain;

        if (!empty($post['groupToResolve'])) {
            $systemID = $post['groupToResolve'];
        } else {
            $link->where('defID', $defID);
            $systemID = $link->getValue('deficiency', 'groupToResolve');
        }
        $link->join('users_enc u', 's.lead = u.userid', 'LEFT');
        $link->where('systemID', $systemID);
        $result = $link->getOne('system s', ['email', 'systemName']);
        $systemName = $result['systemName'];
        if ($result['email']) {
            // use mailgun to email sys lead
            $msg = "$closeReqBy has requested deficiency number $defID be closed."
                ."\nView this deficiency at "
                ."https://{$_SERVER['HTTP_HOST']}/defs.php?search=1&groupToResolve=$systemID&closureRequested=1";
            
            $mgClient->sendMessage($domain, [
                'from' => 'no_reply@mail.svbx.org',
                'to' => $result['email'],
                'subject' => "New closure request for your system: $systemName",
                'text' => $msg
            ]);
        }
    }
    
    echo "<h3>{$link->count}</h3>";
    echo "<p style='color: #1b5'>{$link->getLastQuery()}</p>";
    echo "<p style='color: #c81'>{$link->getLastError()}</p>";
    echo "<a href='/viewDef?defID=$defID'>$defID</a>";

    header("Location: /viewDef.php?defID=$defID");
} catch (Exception $e) {
    header("Location: /updateDef.php?defID=$defID");
    $_SESSION['errorMsg'] = "There was an error in committing your submission: $e";
} finally {
    $link->disconnect();
    exit;
}
