<?php

declare(strict_types=1);

use App\Solvers\Y2020\Day2;

test('Solve Day two part one', function () {
    $solver = new Day2\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(483);
});

test('Solve Day two part two', function () {
    $solver = new Day2\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(482);
});
