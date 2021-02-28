<?php


use App\Solvers\Y2020\Day18\Solver;

test('Solve Day eighteen part one', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(18_213_007_238_947);
});

test('Solve Day seventeen part two', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(3_029_180_675_981);
})->skip();
