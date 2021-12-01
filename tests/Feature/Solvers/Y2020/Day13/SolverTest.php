<?php

declare(strict_types=1);

use App\Contracts\Solver;
use App\Solutions\TodoSolution;
use App\Solvers\Y2020\Day13;

test('Solve Day thirteen part one', function () {
    $solver = new Day13\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(2215);
});

test('Solve Day thirteen part two', function () {
    $solver = new Day13\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution)->toBeInstanceOf(TodoSolution::class);
});
