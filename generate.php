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
for ($i = 0; $i < $rows; $i++) {
    for ($j = 0; $j < $cols; $j++) {
        $matrix[$i][$j] = '_';
    }
}
/*  first point  */
var_dump(addLine($matrix));

for ($i = 0; $i < $rows; $i++) {
    for ($j = 0; $j < $cols; $j++) {
        echo $matrix[$i][$j];
    }
    echo "\n";
}


/*  пытаемся добавить линию  */
function addLine(array &$matrix, array $line = null): array
{
    if ($line == null) {
        /*  это первая линия  */
        $newLine = [
            'x' => rand(0, 2),
            'y' => rand(0, 2),
            'dir' => rand(0, 1)
        ] + makeOperation(null, null, null);
    } else {
        $newLine = [];
    }
    /**/
    $x = $newLine['x'];
    $y = $newLine['y'];
    switch ($newLine['dir']) {
        case 0:
            /*  направо  */
            $matrix[$y][$x] = $newLine['first'];
            $matrix[$y][$x + 1] = $newLine['op'];
            $matrix[$y][$x + 2] = $newLine['second'];
            $matrix[$y][$x + 3] = '=';
            $matrix[$y][$x + 4] = $newLine['result'];
            break;
        case 1:
            /*  вниз  */
            $matrix[$y][$x] = $newLine['first'];
            $matrix[$y + 1][$x] = $newLine['op'];
            $matrix[$y + 2][$x] = $newLine['second'];
            $matrix[$y + 3][$x] = '=';
            $matrix[$y + 4][$x] = $newLine['result'];
            break;
    }
    /**/
    return $newLine;
}

function makeOperation(?int $first, ?int $second, ?int $result): array
{
    if ($first) {
        $op = rand(0, 999) < ($first - 1) * 125 ? '-' : '+';
        $second = $op == '+' ? rand(1, 9 - $first) : rand(1, $first - 1);
        $result = $op == '+' ? $first + $second : $first - $second;
    } else if ($second) {
        $op = rand(0, 999) < ($second - 1) * 125 ? '-' : '+';
        $first = $op == '+' ? rand(1, 9 - $second) : rand(1, $second - 1);
        $result = $op == '+' ? $first + $second : $first - $second;
    } else if ($result) {
        $op = rand(0, 999) < ($result - 1) * 125 ? '-' : '+';
        $second = $op == '+' ? rand(1, $result - 1) : rand(1, 9 - $result);
        $first = $op == '+' ? $result - $second : $result + $second;
    } else {
        $op = rand(0, 99) < 50 ? '-' : '+';
        $result = $op == '+' ? rand(2, 9) : rand(1, 8);
        $first = $op == '+' ? rand(1, $result - 1) : rand($result + 1, 9);
        $second = $op == '+' ? $result - $first : $first - $result;
    }
    return [
        'first' => $first,
        'second' => $second,
        'op' => $op,
        'result' => $result
    ];
}

