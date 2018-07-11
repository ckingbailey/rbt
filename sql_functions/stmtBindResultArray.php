<?php
function stmtBindResultArray(&$stmt) {
    $meta = $stmt->result_metadata();
    $result = [];
    while ($field = $meta->fetch_field()) {
        $params[] = &$row[$field->name];
    }

    call_user_func_array(array($stmt, 'bind_result'), $params);

    while ($stmt->fetch()) {
        foreach($row as $key => $val)
        {
            $c[$key] = $val;
        }
        $result[] = $c;
    }

    return $result;
}

function stmtBindResultArrayRef(&$stmt, array &$array) {
    $meta = $stmt->result_metadata();
    while ($field = $meta->fetch_field()) {
        $params[] = &$row[$field->name];
    }

    if (!call_user_func_array(array($stmt, 'bind_result'), $params))
        return false;

    while ($stmt->fetch()) {
        foreach($row as $key => $val)
        {
            $array[$key]['value'] = $val;
        }
    }

    return true;
}
