<?php

declare(strict_types=1);

use App\Contracts\Solver;
use App\Solvers\Y2020\Day1;

test('Solve Day one part one', function () {
    $solver = new Day1\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(1_020_099);
});

test('Solve Day one part two', function () {
    $solver = new Day1\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(49_214_880);
});
