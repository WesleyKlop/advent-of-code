<?php

use App\Solutions\TodoSolution;
use App\Solvers\Y2020\Day10;

test('Solve Day ten part one', function () {
    $solver = new Day10\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe(2450);
});

test('Solve Day ten part two', function () {
    $solver = new Day10\Solver();

    $solution = $solver->solve('2');

    expect($solution)->toBeInstanceOf(TodoSolution::class);
})->skip('Not finished');;
