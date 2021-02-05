<?php

use App\Solvers\Y2020\Day6;

test('Solve Day six part one', function () {
    $solver = new Day6\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe('6809');
});

test('Solve Day six part two', function () {
    $solver = new Day6\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe('3394');
});
