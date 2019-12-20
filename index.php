<?php

$time_start = microtime(true);

require_once 'helper.php';

// Read input
if (!isset($argv[1])) {
    throw new Exception('Input file argument has to be provided');
}
$file = explode(PHP_EOL, file_get_contents($argv[1]));
$height = (int) explode(',', $file[0])[0];
$width = (int) explode(',', $file[0])[1];
$matrix = array_chunk(explode(',', $file[1]), $width);

// Build horizontal, vertical, and diagonal lookup tables
$lookup = [];
for ($r = 0; $r < $height; $r++) {
    $lookup['h'][$r] = implode($matrix[$r], '');
}
for ($y = 0; $y < $width; $y++) {
    $lookup['v'][$y] = implode(array_column($matrix, $y), '');
}
for ($a = 0; $a <= $width + $height - 2; $a++) {
    for ($c = 0; $c <= $a; $c++) {
        // diagonal 1
        $r = $a - $c;
        if ($r < $height && $c < $width) {
            if (!isset($lookup['d1'][$a])) {
                $lookup['d1'][$a] = '';
            }
            $lookup['d1'][$a] .= $matrix[$r][$c];
            $lookup['d1_coords'][$a][] = [$r, $c];
        }
        // diagonal 2
        $r2 = $height - $r - 1;
        if ($r2 >= 0 && $r2 < $height && $c < $width) {
            if (!isset($lookup['d2'][$a])) {
                $lookup['d2'][$a] = '';
            }
            $lookup['d2'][$a] .= $matrix[$r2][$c];
            $lookup['d2_coords'][$a][] = [$r2, $c];
        }
    }
}

// Find words
$words = explode(',', $file[2]);
$founds = [];
foreach ($words as $word) {
    $wordFound = false;
    $wordLength = strlen($word);

    // At horizontal
    foreach ($lookup['h'] as $r => $row) {
        if ($wordFound) break;
        $v = strpos($row, $word);
        if (!$wordFound && $v !== false) {
            $founds[$word] = generateHorizontalCoordinates($word, $v, $r); $wordFound = true;
        }
        $v = strpos($row, strrev($word));
        if (!$wordFound && $v !== false) {
            $founds[$word] = array_reverse(generateHorizontalCoordinates($word, $v, $r)); $wordFound = true;
        }
    }
    // At vertical
    foreach ($lookup['v'] as $c => $column) {
        if ($wordFound) break;
        $v = strpos($column, $word);
        if (!$wordFound && $v !== false) {
            $founds[$word] = generateVerticalCoordinate($word, $v, $c); $wordFound = true;
        }
        $v = strpos($column, strrev($word));
        if (!$wordFound && $v !== false) {
            $founds[$word] = array_reverse(generateVerticalCoordinate($word, $v, $c)); $wordFound = true;
        }
    }
    // At diagonal 1
    foreach ($lookup['d1'] as $d => $diagonal1) {
        if ($wordFound) break;
        $v = strpos($diagonal1, $word);
        if (!$wordFound && $v !== false) {
            $founds[$word] = array_slice($lookup['d1_coords'][$d], $v, $wordLength); $wordFound = true;
        }
        $v = strpos($diagonal1, strrev($word));
        if (!$wordFound && $v !== false) {
            $founds[$word] = array_reverse(array_slice($lookup['d1_coords'][$d], $v, $wordLength)); $wordFound = true;
        }
    }
    // At diagonal 2
    foreach ($lookup['d2'] as $d => $diagonal2) {
        if ($wordFound) break;
        $v = strpos($diagonal2, $word);
        if (!$wordFound && $v !== false) {
            $founds[$word] = array_slice($lookup['d2_coords'][$d], $v, $wordLength); $wordFound = true;
        }
        $v = strpos($diagonal2, strrev($word));
        if (!$wordFound && $v !== false) {
            $founds[$word] = array_reverse(array_slice($lookup['d2_coords'][$d], $v, $wordLength)); $wordFound = true;
        }
    }
}

// Some visualisation and echo-ing
// renderMatrix($matrix);
renderSolution($founds);

// Print Execution time of the script
echo PHP_EOL;
$time_end = microtime(true);
echo "$time_end - $time_start = " . round(($time_end - $time_start) * 1000) . "ms";
echo PHP_EOL . count(array_unique(array_keys($founds))) . ' unique words' . PHP_EOL;
echo PHP_EOL;