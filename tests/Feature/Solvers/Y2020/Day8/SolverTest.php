<?php

declare(strict_types=1);

use App\Solvers\Y2020\Day8;

test('Solve Day eight part one', function () {
    $solver = new Day8\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(1594);
});

test('Solve Day eight part two', function () {
    $solver = new Day8\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(758);
});
