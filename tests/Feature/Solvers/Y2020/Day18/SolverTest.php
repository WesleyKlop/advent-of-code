<?php

declare(strict_types=1);


use App\Solvers\Y2020\Day18\Solver;

test('Solve Day eighteen part one', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(18_213_007_238_947);
});

test('Solve Day seventeen part two', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(388_966_573_054_664);
});
