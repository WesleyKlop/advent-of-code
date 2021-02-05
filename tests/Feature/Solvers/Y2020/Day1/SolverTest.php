<?php

use App\Solvers\Y2020\Day1;

test('Solve Day one part one', function () {
    $solver = new Day1\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(1020099);
});

test('Solve Day one part two', function () {
    $solver = new Day1\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(49214880);
});
