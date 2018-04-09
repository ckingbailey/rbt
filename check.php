<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php

$string = 'fileend';

$dir = new DirectoryIterator('/home/ubuntu/workspace/');

echo "<ol>";
foreach ($dir as $file) {
    $content = file_get_contents($file->getPathname());
    if (strpos($content, $string) !== false) {
        echo "<li>{$file}</li>";
    }
}
echo "</ol>";
?></body></html>