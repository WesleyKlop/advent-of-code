<?php

use App\Solvers\Y2020\Day3;

test('Solve Day three part one', function () {
    $solver = new Day3\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(145);
});

test('Solve Day three part two', function () {
    $solver = new Day3\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(3424528800);
});
