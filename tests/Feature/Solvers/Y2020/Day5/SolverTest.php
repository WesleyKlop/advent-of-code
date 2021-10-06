<?php

declare(strict_types=1);

use App\Solvers\Y2020\Day5;

test('Solve Day five part one', function () {
    $solver = new Day5\Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(842);
});

test('Solve Day five part two', function () {
    $solver = new Day5\Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(617);
})->skip('Is slow');
