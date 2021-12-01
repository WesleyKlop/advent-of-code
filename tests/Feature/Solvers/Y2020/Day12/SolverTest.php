<?php

declare(strict_types=1);

use App\Contracts\Solver;
use App\Solvers\Y2020\Day12;

test('Solve Day twelve part one', function () {
    $solver = new Day12\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(1631);
});

test('Solve Day twelve part two', function () {
    $solver = new Day12\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(58606);
});
