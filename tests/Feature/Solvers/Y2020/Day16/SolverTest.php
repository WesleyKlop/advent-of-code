<?php


use App\Solvers\Y2020\Day15\Solver;

test('Solve Day fifteen part one', function () {
    $solver = new Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe('276');
});

test('Solve Day fifteen part two', function () {
    $solver = new Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe('31916');
});
