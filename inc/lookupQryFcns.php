<?php
require_once 'sql/lookupSql.php';
require_once 'lookupViewEls.php';
require_once 'utils.php';

/* queries database for list of records for table name passed as arg
**  @param string $table = name of table to get records from
**  @param MysqliDb $link = db link object from joshcam's MySqliDB library
**  @return array $data = array of rows--as arrays--returned from query
*/
function queryLookupTable($tableName, $action, &$link, $id = null) {
    global $sqlStrings;

    $fields = $sqlStrings[$tableName]['list'];
    $idField = $sqlStrings[$tableName]['list'][0];
    
    if ($action === 'update') {
        $link->where($idField, $id);
        $data = $link->getOne($tableName, $fields);
    } else {
        $link->where("$idField <> ''");
        $data = $link->get($tableName, null, $fields);
        foreach ($data as &$row) {
            // re-map row's keys to keys as named in template file
            mapDisplayKeys($row);
            $row['href'] = "/manage.php/update/$tableName?id={$row['id']}";
        }
    }
    
    return $data;
}

function getLookupData($action, $tableName, &$link) {
    global $sqlStrings, $displayNames;
    
    $displayName = isset($displayNames[$tableName])
        ? $displayNames[$tableName]
        : $tableName;
    $names = array(
        $sqlStrings[$tableName]['update'][0],
        $sqlStrings[$tableName]['update'][1]
    );
            
    if ($action === 'add') {
        $formCtrls = array(
            "<label for='{$names[0]}' class='required'>" . ucfirst($displayName) . " name</label>
            <input name='{$names[0]}' type='text' maxlength='50' class='form-control item-margin-bottom' required>",
            "<label for='{$names[1]}'>" . ucfirst($displayName) . " description</label>
            <textarea name='{$names[1]}' maxlength='255' class='form-control item-margin-bottom'></textarea>"
        );
    
        return array(
            'cardHeading' => 'Enter ' . $displayName . ' information',
            'formTarget' => '/commit/commitLookupData.php',
            'formCtrls' => $formCtrls
        );
    } elseif ($action ==='update') {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_ENCODED);
        $data = queryLookupTable($tableName, 'update', $link, $id);
        $formCtrls = array_map(function ($n) use ($names, $displayName, $data) {
            static $i = 0;
            $ctrl = sprintf($n, $names[$i], ucfirst($displayName), $data[$names[$i]]);
            $i++;
            return $ctrl;
        }, $sqlStrings[$tableName]['formCtrls']);
        return array(
            'formTarget' => '/commit/updateLookupData.php',
            'cardHeading' => 'Enter ' . $displayName . ' information',
            'formCtrls' => $formCtrls,
            'id' => $id
        );
    } else { // fallback is 'list' view
        return array(
            'data' => queryLookupTable($tableName, 'list', $link),
            'count' => $link->count,
            'addPath' => "manage.php/add/$tableName"
        );
    }
}
