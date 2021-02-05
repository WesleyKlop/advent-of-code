<?php


use App\Solvers\Y2020\Day14\Solver;

test('Solve Day fourteen part one', function () {
    $solver = new Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(2346881602152);
});

test('Solve Day fourteen part two', function () {
    $solver = new Solver();

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(3885232834169);
});
