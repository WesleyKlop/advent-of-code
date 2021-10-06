<?php

declare(strict_types=1);

use App\Solvers\Y2020\Day4;

test('Solve Day four part one', function () {
    $solver = app(Day4\Solver::class);

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(170);
});

test('Solve Day four part two', function () {
    $solver = app(Day4\Solver::class);

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(103);
});
