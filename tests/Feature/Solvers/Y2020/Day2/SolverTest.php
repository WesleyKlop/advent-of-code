<?php

use App\Solvers\Y2020\Day2;

test('Solve Day two part one', function () {
    $solver = new Day2\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(483);
});

test('Solve Day two part two', function () {
    $solver = new Day2\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(482);
});
