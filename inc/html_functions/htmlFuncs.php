<?php
// returns one of two html strings for the existence or emptiness of a var $val
function returnHtmlForVal($val, $ifHtml, $elseHtml) {
    return (($val === null || $val === '')
        ? sprintf($elseHtml, $val)
        : sprintf($ifHtml, $val));
}

function returnClassList($arrVal) {
    $classList = " ";
    if (is_string($arrVal)) $classList = " class='$arrVal'";
    elseif (is_array($arrVal)) $classList = " class='".implode(' ', $arrVal)."'";
    return $classList;
}

function returnHtmlFromArray(array $htmlArr) {
    // placeholder
}
?>