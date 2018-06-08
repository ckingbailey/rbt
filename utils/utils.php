<?php
function boolToStr($bool) {
    return ($bool ? 'true' : 'false');
}

function isHtmlStr(string $str) {
    /* '/(?<=<)\w+(?=[^<]*?>)/'
    ** "/(?<=<)\w+(?=[^<]*?>)/"
    ** '/<\s?[^\>]*\/?\s?>/i'
    */
}
?>