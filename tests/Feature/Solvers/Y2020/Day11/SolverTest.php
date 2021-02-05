<?php

use App\Solvers\Y2020\Day11;

test('Solve Day eleven part one', function () {
    $solver = new Day11\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe('2164');
});

test('Solve Day eleven part two', function () {
    $solver = new Day11\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe('1974');
});
