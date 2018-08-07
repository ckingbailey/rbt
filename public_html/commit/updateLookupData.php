<?php
$basedir = $_SERVER['DOCUMENT_ROOT'] . '/..';
require_once "$basedir/vendor/autoload.php";
require_once "$basedir/inc/sql_functions/sqlFunctions.php";
require_once "$basedir/inc/sql/lookupSql.php";

session_start();

try {
    $link = connect();
    
    if (!$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS))
        throw new UnexpectedValueException('Could not retrieve the post data');
        
    $tableName = $post['target'];
    $id = $post['id'];
    unset($post['target'], $post['id']);
    
    $link->where($sqlStrings[$tableName]['list'][0], $id);
    $count = $link->update($tableName, $post);
    
    header("Location: /manage.php/update/$tableName?id=$id");
} catch (UnexpectedValueException $e) {
    
} catch (mysqli_sql_exception $e) {
    
} catch (Exception $e) {
    
} finally {
    $link->disconnect();
    exit;
}