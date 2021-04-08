<?php

/*  get params  */
if ($argc != 4) {
    echo "Usage: php generate.php <cols> <rows> <file-name>\n";
    exit;
}
$cols = intval($argv[1]);
if ($cols <= 11 || $cols > 100) {
    echo "cols must be between 11 and 100\n";
    exit;
}
$rows = intval($argv[2]);
if ($rows <= 11 || $rows > 100) {
    echo "rows must be between 11 and 100\n";
    exit;
}
$fileName = $argv[3];
if (file_exists($fileName)) {
    echo "file $fileName exists, select another file name or remove file\n";
    exit;
}

/*  generate matrix  */
echo "generate $fileName with $cols cols and $rows rows\n";
$matrix = [];
for