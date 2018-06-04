<?php
session_start();
include('SQLFunctions.php');
include('error_handling/sqlErrors.php');
include('uploadImg.php');
$link = f_sqlConnect();

$date = date('Y-m-d');
$nullVal = null;

// prepare POST and sql string for commit
$post = $_POST;
$fieldList = preg_replace('/\s+/', '', file_get_contents('bartdl.sql')).',date_created';
$fieldsArr = array_fill_keys(explode(',', $fieldList), '?');
// unset keys that will not be INSERT'd
unset($fieldsArr['id']);
$fieldList = implode(',', array_keys($fieldsArr));
$sql = 'INSERT INTO BARTDL ('.implode(', ', array_keys($fieldsArr)).') VALUES ('.implode(', ', array_values($fieldsArr)).')';

if ($stmt = $link->prepare($sql)) {
    $types = 'iiiiisssiiiiiissssssssis';
    if ($stmt->bind_param($types,
        intval($post['created_by']),
        intval($post['created_by']),
        intval($post['creator']),
        intval($post['next_step']),
        intval($post['bic']),
        $link->escape_string($post['descriptive_title_vta']),
        $link->escape_string($post['root_prob_vta']),
        $link->escape_string($post['resolution_vta']),
        intval($post['status_vta']),
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
        intval($post['status_bart']),
        $date
    )) {
        if ($stmt->execute()) {
            echo "
                <div style='margin-top: 3.5rem; color: purple'>
                    <p>{$stmt->affected_rows}</p>
                    <p>{$stmt->insert_id}</p>
                    <p>$fieldList</p>
                    <p>$sql</p>
                    <p>$types</p>
                </div>";
            // echo "<pre>";
            // var_dump($post);
            // echo "</pre>";
            header("Location: ViewDef.php?bartDefID={$stmt->insert_id}");
        } else {
            printSqlErrorAndExit($stmt, $sql);
        }
    } else {
        printSqlErrorAndExit($stmt, $sql);
    }
} else {
    printSqlErrorAndExit($link, $sql);
}