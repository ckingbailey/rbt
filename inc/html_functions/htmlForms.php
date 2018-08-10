<?php
require_once "sql_functions/sqlFunctions.php";

function returnSelectInput($data) {
    $cnxn = f_sqlConnect();
    $selectEl = $data['element'];
    $optionFormat = "<option value='%s'%s>%s</option>";
    $emptyOption = sprintf($optionFormat, '', '', '');
    $optionEls = $emptyOption;
    $value = isset($data['value']) ? $data['value'] : '';
    // if val @ [query] is a string, use it to query db
    // if val @ [query] is a sql query result, use it
    $result = is_string($data['query']) ? $cnxn->query($data['query']) : $data['query'];
    if ($result) {
        if (is_a($result, 'mysqli_result')) {
            while ($row = $result->fetch_row()) {
                $selected = $row[0] == $value ? ' selected' : '';
                $optionEls .= sprintf($optionFormat, $row[0], $selected, $row[1]);
            }
            $result->close();
        } elseif (is_array($result)) {
            foreach ($result as $optVal => $optText) {
                $selected = $optVal === $value ? ' selected' : '';
                $curOpt = sprintf($optionFormat, $optVal, $selected, $optText);
                $optionEls .= $curOpt;
            }
        }
    } elseif ($cnxn->error) {
        $optionEls .= "<option selected>{$cnxn->error}</option>";
    } else $optionEls .= "<option selected>There was a problem with the query</option>";
    $selectEl = sprintf($data['element'], $optionEls);
    $cnxn->close();
    return $selectEl;
}

function returnCheckboxInput($data) {
    $value = isset($data['value']) ? $data['value'] : '';
    $checked = $value ? ' checked' : '';
    $inputEl = sprintf($data['element'], $checked);
    return $inputEl;
}

function returnTextInput($data) {
    $value = isset($data['value']) ? stripcslashes($data['value']) : '';
    $inputEl = sprintf($data['element'], $value);
    return $inputEl;
}

function returnDateInput($data) {
    $value = isset($data['value']) ? $data['value'] : '';
    $dateEl = sprintf($data['element'], $value);
    return $dateEl;
}

function returnFileInput($data) {
    return $data['element'];
}

function returnTextarea($data) {
    $value = isset($data['value']) ? stripcslashes($data['value']) : '';
    $textarea = sprintf($data['element'], $value);
    return $textarea;
}

function returnFormCtrl($formCtrl) {
    if ($formCtrl['tagName'] === 'select') {
        return returnSelectInput($formCtrl);
    } elseif ($formCtrl['tagName'] === 'input') {
        if ($formCtrl['type'] === 'text') {
            return returnTextInput($formCtrl);
        } elseif ($formCtrl['type'] === 'checkbox') {
            return returnCheckboxInput($formCtrl);
        } elseif ($formCtrl['type'] === 'date') {
            return returnDateInput($formCtrl);
        } elseif ($formCtrl['type'] === 'file') {
            // $col .= "<h3 style='color: var(--purple)'>type === file</h3>";
            return returnFileInput($formCtrl);
        }
    } elseif ($formCtrl['tagName'] === 'textarea') {
        return returnTextarea($formCtrl);
    }
}

?>
