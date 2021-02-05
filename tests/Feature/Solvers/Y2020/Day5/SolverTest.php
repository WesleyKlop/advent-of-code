<?php

use App\Solvers\Y2020\Day5;

test('Solve Day five part one', function () {
    $solver = new Day5\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe('842');
});

test('Solve Day five part two', function () {
    $solver = new Day5\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe('617');
});
