<?php
require_once 'htmlForms.php';
/*
** available options at this point are:
** 'inline'
** 'colWd'
** 'offset'
*/
// this function should receive a complete element string unless it's a select element that needs iterating over
function returnCol($element, $wd, $options = []) {
    $colStr = "<div class='col-md-%s'>%s</div>";
    $wd = isset($options['offset']) ? $wd." offset-md-{$options['offset']}" : $wd;
    if (is_array($element)) {
        $isFormCtrl = $element['tagName'] === 'select'
            || $element['tagName'] === 'input'
            || $element['tagName'] === 'textarea';
        $content = $isFormCtrl
            ? isset($options['inline'])
                ? returnRow([ $element['label'], returnFormCtrl($element) ])
                : $element['label'].returnFormCtrl($element)
            : returnRow($element);
        $col = sprintf($colStr, $wd, $content);
    } elseif (is_string($element)) {
        $col = sprintf($colStr, $wd, $element);
    } else $col = sprintf($colStr,  $wd, '');
    return $col;
}

function returnRow($elements, $options = []) {
    $elRow = "<div class='row item-margin-bottom'>";
    $numEls = count($elements);
    // if number of elements don't divide evenly by 12 substract out the remainder
    // this number will be added to the last col
    $extraCols = 12 % $numEls;
    $colWd = 12 / ($numEls - $extraCols);
    // if row is singular and has a specific wd, pass it and its wd to returnCol without looping
    if (count($elements) === 1 && isset($options['colWd'])) {
        $offset = floor((12 - $options['colWd'])/2);
        $elRow .= returnCol(array_shift($elements), $options['colWd'], ['offset' => $offset]);
    } else foreach ($elements as $el) {
        $elRow .= returnCol($el, $colWd, $options);
    }
    $elRow .= "</div>";
    return $elRow;
}
?>