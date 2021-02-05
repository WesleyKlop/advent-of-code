<?php

use App\Solvers\Y2020\Day12;

test('Solve Day twelve part one', function () {
    $solver = new Day12\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(1631);
});

test('Solve Day twelve part two', function () {
    $solver = new Day12\Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(58606);
});
