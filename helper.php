<?php

function renderMatrix(array $matrix)
{
    // Assume width
    $width = count($matrix[0]);

    // Print matrix
    echo '  ' . implode(range(0, $width - 1), '  ') . PHP_EOL;
    foreach ($matrix as $y => $row) {
        echo $y . ' ';
        echo implode($row, '  ') . PHP_EOL;
    }
    echo PHP_EOL;
}

function renderSolution(array $founds)
{
    // Print solution
    foreach ($founds as $word => $coordinates) {
        $string = $word . ' ';
        foreach ($coordinates as $c) {
            $string .= '[' . implode(', ', $c) . '] ';
        }
        echo $string . PHP_EOL;
    }
}

function generateHorizontalCoordinates($word, $v, $r)
{
    $coords = [];
    for ($i = 0; $i < strlen($word); $i++) {
        $coords[] = [$r, $v + $i];
    }
    return $coords;
}

function generateVerticalCoordinate($word, $v, $c)
{
    $coords = [];
    for ($i = 0; $i < strlen($word); $i++) {
        $coords[] = [$v + $i, $c];
    }
    return $coords;
}

function generateDiagonal1Coordinate($word, $v, $d, $width, $height)
{
    $coords = [];
    for ($i = 0; $i < strlen($word); $i++) { // TODO: i love my holiday. merry xmas and happy new year
        $coords[] = [rand(0, $width - 1), rand(0, $height - 1)];
    }
    return $coords;
}