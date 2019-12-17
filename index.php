<?php
require_once 'helper.php';

if (!isset($argv[1])) {
    throw new Exception('Input file argument has to be provided');
}
$file = explode(PHP_EOL, file_get_contents($argv[1]));
$height = (int) explode(',', $file[0])[0];
$width = (int) explode(',', $file[0])[1];
$matrix = array_chunk(explode(',', $file[1]), $width);

// Build horizontal, vertical, and diagonal lookup tables
$lookupDict = [];
for ($x = 0; $x < $height; $x++) {
    $lookupDict['h'][$x] = implode($matrix[$x], '');
}
for ($y = 0; $y < $width; $y++) {
    $lookupDict['v'][$y] = implode(array_column($matrix, $y), '');
}
for ($a = 0; $a <= $width + $height - 2; $a++) {
    for ($b = 0; $b <= $a; $b++) {
        $c = $a - $b;
        if ($c < $height && $b < $width) {
            if (!isset($lookupDict['d'][$a])) {
                $lookupDict['d'][$a] = '';
            }
            $lookupDict['d'][$a] .= $matrix[$c][$b];
        }
    }
}

// Find words
$words = explode(',', $file[2]);
$founds = [];
foreach ($words as $word) {
    // At horizontal
    foreach ($lookupDict['h'] as $x => $row) {
        $v = strpos($row, $word);
        if ($v !== false) echo $word . ' h: ' . $v .  PHP_EOL;
        $v = strpos($row, strrev($word));
        if ($v !== false) echo $word . ' h: ' . $v .  PHP_EOL;
    }
    // At vertical
    foreach ($lookupDict['v'] as $y => $column) {
//        $found = find($column, $word, $y, function ($w, $v, $i) { return [$w, $v + $i]; });
//        if ($found) {
//            $founds[$word][] = $found;
//        }
        $found = find($column, strrev($word), $y, function ($w, $v, $i) { return [$w, $v + $i]; });
        if ($found) {
            $founds[$word][] = $found;
        }
    }
    // At diagonal
    foreach ($lookupDict['d'] as $d => $diagonal) {
        $v = strpos($diagonal, $word);
        if ($v !== false) echo $word . PHP_EOL;
        $v = strpos($diagonal, strrev($word));
        if ($v !== false) echo $word . PHP_EOL;
    }
}

function find($string, $word, $w, callable $coordinateFn) {
    $v = strpos($string, $word);
    if ($v !== false) {
        return array_map(function ($c, $i) use ($coordinateFn, $v, $w) {
            list($x, $y) = $coordinateFn($w, $v, $i);
            return [$c, $x, $y];
        }, str_split($word), array_keys(str_split($word)));
    }
    return false;
}

// Some visualisation
renderMatrix($matrix);
renderSolution($founds);