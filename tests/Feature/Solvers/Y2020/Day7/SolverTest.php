<?php

use App\Solvers\Y2020\Day7;

test('Solve Day seven part one', function () {
    $solver = new Day7\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe('192');
});

test('Solve Day seven part two', function () {
    $solver = new Day7\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe('12128');
});
