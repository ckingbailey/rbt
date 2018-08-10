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

function pluralize($singular) {
    if (substr($singular, -1) === 'y' && substr($singular, -2) !== 'ey') {
        return substr($singular, 0, strlen($singular) - 1) . 'ies';
    } elseif (substr($singular, -1) === 's') {
        return $singular . 'es';
    } else return $singular . 's';
}

/* mutates array arg $row, mapping values to keys as they appear in template
**  @param array $row = a row of data returned from sql query
*/
function mapDisplayKeys(array &$row) {
    $displayKeys = [ 'id', 'name', 'description' ];
    
    if (count($row) !== count($displayKeys))
        throw new InvalidArgumentException('Wrong number of values in query. Expected 3 keys but found ' . count($row));
    
    $indexed = array_values($row);
    $row = array_combine($displayKeys, $indexed);
}
