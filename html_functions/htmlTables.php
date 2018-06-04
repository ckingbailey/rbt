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
function printTableHeadings($fields, $authLvl) {
    $thead = "<thead><tr>%s</tr></thead>";
    $th = "<th %s>%s</th>";
    $headings = '';
    foreach ($fields as $field) {
        if (is_string($field)) {
            $curHeading = sprintf($th, '', $field);
        } elseif (is_array($field)) {
            if ($field['auth'] && $authLvl < $field['auth']) continue;
            $text = $field['text'];
            $classList = returnClassList($field['classList']);
            $curHeading = sprintf($th, $classList, $text);
        }
        $headings .= $curHeading;
    }
    printf($thead, $headings);
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
function populateTable(&$res, $fields, $authLvl) {
    $tbody = "<tbody>%s</tbody>";
    $tr = "<tr>%s</tr>";
    $td = "<td%s>%s</td>";
    $tableRows = '';
    while($row = $res->fetch_row()) {
        $i = 0;
        $curRow = '';
        $end = end(array_keys($fields));
        foreach ($fields as $field) {
            $datum = $i === $end ? $row[0] : $row[$i];
            if (is_string($field)) $curTd = sprintf(is_string($field), $datum);
            elseif (is_array($field)) {
                $curField = $field;
                if ($curField['auth'] && $authLvl < $curField['auth']) continue;
                // should factor this out into sep fcn and test for # %s args
                // the only way to do this is with regex, yecch!
                $innerHtml = $curField['innerHtml'] ? sprintf($curField['innerHtml'], $datum, $datum) : $datum;
                $classList = returnClassList($curField['classList']);
                $curTd = sprintf($td, $classList, $innerHtml);
            }
            $curRow .= $curTd;
            $i++;
        }
        // print "<h4 class='text-yellow'>".$end."</h4>";
        $curRow = sprintf($tr, $curRow);
        $tableRows .= $curRow;
    }
    printf($tbody, $tableRows);
}
?>