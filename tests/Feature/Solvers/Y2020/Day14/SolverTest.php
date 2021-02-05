<?php


test('Solve Day fourteen part one', function () {
    $solver = new \App\Solvers\Y2020\Day14\Solver();

    $solution = $solver->solve('1');

    expect($solution->value())->toBe('2346881602152');
})->skip();

test('Solve Day fourteen part two', function () {
    // Todo
})->skip();
