<?php

declare(strict_types=1);

use App\Contracts\Solver;
use App\Solvers\Y2020\Day11;

test('Solve Day eleven part one', function () {
    $solver = new Day11\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(2164);
})->skip('Is very slow');

test('Solve Day eleven part two', function () {
    $solver = new Day11\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(1974);
})->skip('Is very slow');
