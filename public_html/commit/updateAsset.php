<?php
$base = $_SERVER['DOCUMENT_ROOT'] . '/..';
require_once "$base/vendor/autoload.php";
require_once "$base/inc/sql_functions/sqlFunctions.php";

session_start();

try {
    if (!$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS))
        throw new UnexpectedValueException('Unable to retrieve POST data');
    
    $assetID = $post['assetID'];
    unset($post['assetID']);
    
    unset($post['target']);
    unset($post['id']);
    $post['updatedBy'] = $_SESSION['userID'];
    $post['lastUpdated'] = date('Y-m-d H:i:s');
    
    $link = connect();
    
    $link->where('assetID', $assetID);
    $count = $link->update('asset', $post);
    
    if ($count) { // on success, redirect to asset list
        header('Location: /assets.php');
    } else {
        echo "
            <pre style='color: #953cbe'>
            <h3 style='color: #c23'>{$link->getLastError()}</h3>
            <h4 style='color: #ba1'>{$link->getLastQuery()}</h4>";
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
