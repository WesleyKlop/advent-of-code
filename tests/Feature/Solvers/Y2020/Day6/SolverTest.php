<?php

declare(strict_types=1);

use App\Solvers\Y2020\Day6;

test('Solve Day six part one', function () {
    $solver = new Day6\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(6809);
});

test('Solve Day six part two', function () {
    $solver = new Day6\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(3394);
});
