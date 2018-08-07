<?php
$basedir = $_SERVER['DOCUMENT_ROOT'] . '/..';
require_once "$basedir/vendor/autoload.php";
require_once "sql_functions/sqlFunctions.php";
require_once "sql/lookupSql.php";

session_start();

try {
    $link = connect();

    if (!$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS))
        throw new Exception('There was a problem with the post data');
        
    // get sql string by value of hidden input in form
    $table = $post['target'];
    $sql = $sqlStrings[$table]['add'];

    unset($post['target']);
    $post['updatedBy'] = $_SESSION['UserID'];
    $post['dateCreated'] = date('Y-m-d H:i:s');
    
    if (!$id = $link->insert($table, $post)) throw new mysqli_sql_exception($link->getLastError());
    
    header("Location: /manage.php/list/$table");
    
} catch (mysqli_sql_exception $e) {
    echo "<pre style='color: coral'>$e</pre>";
} catch (Exception $e) {
    echo "<pre style='color: salmon'>$e</pre>";
} finally {
    $link->disconnect();
    exit;    
}
