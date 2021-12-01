<?php

declare(strict_types=1);

use App\Contracts\Solver;
use App\Solvers\Y2020\Day3;

test('Solve Day three part one', function () {
    $solver = new Day3\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(145);
});

test('Solve Day three part two', function () {
    $solver = new Day3\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(3_424_528_800);
});
