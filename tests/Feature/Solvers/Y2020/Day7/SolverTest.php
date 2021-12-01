<?php

declare(strict_types=1);

use App\Contracts\Solver;
use App\Solvers\Y2020\Day7;

test('Solve Day seven part one', function () {
    $solver = new Day7\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(192);
});

test('Solve Day seven part two', function () {
    $solver = new Day7\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(12128);
});
