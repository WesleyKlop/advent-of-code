<?php

declare(strict_types=1);

use App\Contracts\Solver;
use App\Solutions\TodoSolution;
use App\Solvers\Y2020\Day10;

test('Solve Day ten part one', function () {
    $solver = new Day10\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(2450);
});

test('Solve Day ten part two', function () {
    $solver = new Day10\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution)->toBeInstanceOf(TodoSolution::class);
})->skip('Not finished');
