<?php

use App\Solvers\Y2020\Day8;

test('Solve Day eight part one', function () {
    $solver = new Day8\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(1594);
});

test('Solve Day eight part two', function () {
    $solver = new Day8\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(758);
});
