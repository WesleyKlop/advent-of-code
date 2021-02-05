<?php

use App\Solvers\Y2020\Day9;

test('Solve Day nine part one', function () {
    $solver = new Day9\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(57195069);
});

test('Solve Day nine part two', function () {
    $solver = new Day9\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(7409241);
});
