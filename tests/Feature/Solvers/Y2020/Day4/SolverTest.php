<?php

use App\Solvers\Y2020\Day4;

test('Solve Day four part one', function () {
    $solver = app(Day4\Solver::class);

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(170);
});

test('Solve Day four part two', function () {
    $solver = app(Day4\Solver::class);

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(103);
});
