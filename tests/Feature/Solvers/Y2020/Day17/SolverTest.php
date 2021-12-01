<?php

declare(strict_types=1);


use App\Solvers\Y2020\Day17\Solver;

test('Solve Day seventeen part one', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve(\App\Contracts\Solver::PART_ONE);

    expect($solution->value())->toBe(267);
})->skip('Broken by wip');

test('Solve Day seventeen part two', function () {
    $solver = app(Solver::class);

    $solution = $solver->solve(\App\Contracts\Solver::PART_TWO);

    expect($solution->value())->toBe(3_029_180_675_981);
})->skip('Not finished');
