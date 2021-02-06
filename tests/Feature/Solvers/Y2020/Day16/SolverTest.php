<?php


use App\Solvers\Y2020\Day16\Solver;

test('Solve Day sixteen part one', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(29_851);
});

test('Solve Day sixteen part two', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(3_029_180_675_981);
});
