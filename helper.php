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

