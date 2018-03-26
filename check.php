<?php

$string = 'filestart';

$dir = new DirectoryIterator('/home/ubuntu/workspace/');
foreach ($dir as $file) {
    $content = file_get_contents($file->getPathname());
    if (strpos($content, $string) !== false) {
        echo $file.", ";
    }
}
?>