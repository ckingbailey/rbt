<?php
require_once 'html_functions/htmlFuncs.php';
/*
EXAMPLE $fields ARRAY:
[
    [
        'auth' => int,
        'text' => 'heading text',
        'classList' => [ 'array', 'of', 'classes' ] || 'string of classes'
    ]
]
*/
function printTableHeadings($headers, $userLvl) {
    $thead = "<thead><tr>%s</tr></thead>";
    $th = "<th %s>%s</th>";
    $tHeadings = '';
    foreach ($headers as $header) {
        $header['auth'] = isset($header['auth']) ? $header['auth'] : 0;
        if (is_string($header)) {
            $tHeadings .= sprintf($th, '', $header);
        } elseif (is_array($header)) {
            if ($userLvl < $header['auth']) continue;
            else {
                $text = $header['text'];
                $classList = isset($header['classList'])
                    ? returnClassList($header['classList']) : '';
                $tHeadings .= sprintf($th, $classList, $text);
            }
        } else $tHeadings .= sprintf($th, '', $text);
    }
    printf($thead, $tHeadings);
}

/*
** For now this fn takes arrays of html props and assembles them into <td>
** I would prefer that it also be able to take a complete html 'element' string, with format markers %s
** ARRAY PARAMS:
**   auth
**   innerHtml
**   classList
** ISSUE: 'innerHtml' prop requires two %s args. It would be nice if I could detect # of args and fill them appropriately
*/
function populateTable(&$res, $cells, $userLvl) {
    $tbody = "<tbody>%s</tbody>";
    $tr = "<tr>%s</tr>";
    $td = "<td%s>%s</td>";
    $tableRows = '';
    foreach ($res as $row) {
        $fields = '';
        foreach ($cells as $col => $cell) {
            if ($col === 'edit' || $col === 'delete') {
                $val = stripcslashes($row['ID']);
            } else {
                $val = isset($row[$col])
                    ? stripcslashes($row[$col]) : 'no data found';
            }
            if (is_string($cell)) $fields .= sprintf($cell, $val);
            elseif (is_array($cell)) {
                $cell['auth'] = isset($cell['auth'])
                    ? $cell['auth'] : 0;
                if ($userLvl < $cell['auth']) continue;
                else {
                    $innerHtml = isset($cell['innerHtml'])
                        ? sprintf($cell['innerHtml'], $val, $val)
                        : $val;
                    $classList = isset($cell['classList'])
                        ? returnClassList($cell['classList']) : '';
                    $fields .= sprintf($td, $classList, $innerHtml);
                }
            } else $fields .= sprintf($td, '', $val);
        }
        $tableRows .= sprintf($tr, $fields);
    }
    printf($tbody, $tableRows);
}
?>
