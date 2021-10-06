<?php

declare(strict_types=1);


use App\Solvers\Y2020\Day15\Solver;

uses()->group('Day 15');

test('Solve Day fifteen part one', function () {
    $solver = new Solver();

    $solution = $solver->solve(Solver::PART_ONE);

    expect($solution->value())->toBe(276);
});

test('Solve Day fifteen part two', function () {
    $solver = new Solver();

    $solution = $solver->solve(Solver::PART_TWO);

    expect($solution->value())->toBe(31916);
})->skip('Is very slow');
