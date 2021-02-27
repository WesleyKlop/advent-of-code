<?php


use App\Solvers\Y2020\Day17\Solver;

test('Solve Day seventeen part one', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(267);
});

test('Solve Day seventeen part two', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve('2');

    expect($solution->value())->toBe(3_029_180_675_981);
})->skip();
