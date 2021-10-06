<?php

declare(strict_types=1);

use App\Solvers\Y2020\Day9;

test('Solve Day nine part one', function () {
    $solver = new Day9\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(57195069);
});

test('Solve Day nine part two', function () {
    $solver = new Day9\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(7409241);
});
