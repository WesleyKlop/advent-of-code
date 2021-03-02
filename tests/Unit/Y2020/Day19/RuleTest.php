<?php

use App\Solvers\Y2020\Day19\AndRule;
use App\Solvers\Y2020\Day19\OrRule;
use App\Solvers\Y2020\Day19\StringRule;

test('StringRule works with single characters', function () {
    $aRule = new StringRule('a');

    expect($aRule->matches('a'))->toBeTrue();
    expect($aRule->matches('b'))->toBeFalse();
});

test('StringRule compiles to a single pattern', function () {
    $aRule = new StringRule('a');
    $compiled = $aRule->compile();

    expect($compiled)->toHaveCount(1);
});

test('OrRule works with simple rules', function () {
    $orRule = new OrRule([new StringRule('a'), new StringRule('b')]);

    expect($orRule->matches('a'))->toBeTrue();
    expect($orRule->matches('b'))->toBeTrue();
});

test('Simple OrRule compiles to 2 patterns', function () {
    $orRule = new OrRule([new StringRule('a'), new StringRule('b')]);
    $compiled = $orRule->compile();

    expect($compiled)->toHaveCount(2);
});


test('AndRule compiles to 1 pattern', function () {
    $andRule = new AndRule([new StringRule('a'), new StringRule('b')]);
    $compiled = $andRule->compile();

    expect($compiled)->toHaveCount(1);
});

test('AndRule with OrRule compiles to two patterns', function () {
    $rule = new AndRule([
        new StringRule('a'),
        new OrRule([new StringRule('a'), new StringRule('b')])
    ]);
    $compiled = $rule->compile();

    expect($compiled)->toHaveCount(2);
});

test('AndRule with more than 2 rules compiles', function () {
    $rule = new AndRule([
        new StringRule('a'),
        new StringRule('a'),
        new StringRule('a'),
        new StringRule('a'),
        ]);

    $compiled = $rule->compile();

    expect($compiled)->toHaveCount(1);
});
