<?php

declare(strict_types=1);


use App\Solvers\Y2020\Day16\Solver;

test('Solve Day sixteen part one', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve(\App\Contracts\Solver::PART_ONE);

    expect($solution->value())->toBe(29_851);
});

test('Solve Day sixteen part two', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve(\App\Contracts\Solver::PART_TWO);

    expect($solution->value())->toBe(3_029_180_675_981);
});
