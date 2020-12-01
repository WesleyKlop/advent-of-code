<?php

use App\Solvers\Y2019\Day14\Chemical;
use App\Solvers\Y2019\Day14\NanoFactory;
use App\Solvers\Y2019\Day14\Reaction;
use App\Solvers\Y2019\Day14\ReactionFactory;

/* Test string. */
$reactionsList = <<<EOF
10 ORE => 10 A
1 ORE => 1 B
7 A, 1 B => 1 C
7 A, 1 C => 1 D
7 A, 1 D => 1 E
7 A, 1 E => 1 FUEL
EOF;

it('can parse a list of reactions', function () use ($reactionsList) {
    $reactions = ReactionFactory::fromString($reactionsList);

    expect($reactions)->not->toBeEmpty();
});


it('can retrieve a reaction from a nanofactory', function () use ($reactionsList) {
    $factory = new NanoFactory(ReactionFactory::fromString($reactionsList));

    expect($factory->getReactionThatProduces(Chemical::FUEL, 1))
        ->toBeInstanceOf(Reaction::class);
});

it('can break down a piece of fuel into its direct components', function () {
    $factory = new NanoFactory(ReactionFactory::fromString("7 A, 1 E => 1 FUEL"));

    $toBreakDown = collect([
        Chemical::FUEL => 1,
    ]);

    $result = $factory->process($toBreakDown);

    expect($result->get('A'))
        ->toBe(7)
        ->and($result->get('E'))
        ->toBe(1);
});

it('can break down a piece of fuel into its base component', function () use ($reactionsList) {
    $factory = new NanoFactory(ReactionFactory::fromString($reactionsList));

    $toBreakDown = collect([
        Chemical::FUEL => 1,
    ]);

    $result = $factory->process($toBreakDown);

    expect($result->get(Chemical::ORE))
        ->toBe(31);
})->skip();

it('can always produce ore', function () {
    $factory = new NanoFactory(ReactionFactory::fromString(
        <<<EOR
10 ORE => 10 A
1 ORE => 1 B
7 A, 1 B => 1 FUEL
EOR
    ));

    $result = $factory->process(collect([
        'FUEL' => 1,
    ]));

    expect($result->get(Chemical::ORE))
        ->toBe(11);
})->skip();
