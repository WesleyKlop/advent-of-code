<?php

declare(strict_types=1);


use App\Solvers\Y2020\Day14\Solver;

test('Solve Day fourteen part one', function () {
    $solver = new Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(2_346_881_602_152);
});

test('Solve Day fourteen part two', function () {
    $solver = new Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(3_885_232_834_169);
});
