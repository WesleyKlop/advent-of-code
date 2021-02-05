<?php

use App\Solutions\TodoSolution;
use App\Solvers\Y2020\Day13;

test('Solve Day thirteen part one', function () {
    $solver = new Day13\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(2215);
});

test('Solve Day thirteen part two', function () {
    $solver = new Day13\Solver();

    $solution = $solver->solve('2');

    expect($solution)->toBeInstanceOf(TodoSolution::class);
});
