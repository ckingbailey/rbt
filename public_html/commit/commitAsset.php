<?php
$base = $_SERVER['DOCUMENT_ROOT'] . '/..';
require_once "$base/vendor/autoload.php";
require_once "$base/inc/sqlFunctions.php";

require "session.php";

try {
    if (!$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS))
        throw new UnexpectedValueException('Unable to retrieve POST data');
        
    unset($post['target']);
    $post['dateCreated'] = date('Y-m-d H:i:s');
    $post['createdBy'] = $_SESSION['userID'];
    $post['updatedBy'] = $post['createdBy'];
    
    $link = connect();
    
    $assetID = $link->insert('asset', $post);
    
    if ($assetID) { // on success, redirect to asset list
        header('Location: /assets.php');
    } else {
        echo "
            <pre style='color: #953cbe'>
            <h4>{$link->getLastQuery()}</h4>";
            print_r($post);
        echo "</pre>";
    }
} catch (mysqli_sql_exception $e) {
    echo "<h4>Error</h4><p>$e</p>";
} catch (UnexpectedValueException $e) {
    echo "<h4>Error</h4><p>$e</p>";
} catch (Exception $e) {
    echo "<h4>Error</h4><p>$e</p>";
} finally {
    $link->disconnect();
    exit;    
}
