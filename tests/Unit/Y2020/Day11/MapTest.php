<?php

declare(strict_types=1);

use App\Solvers\Y2020\Day11\Map;
use App\Solvers\Y2020\Day11\PartOneStrategy;

$testMap = <<<MAP
L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL
MAP;
$strategy = new PartOneStrategy();


it('can create a test map', function () use ($strategy, $testMap) {
    $map = Map::fromString($strategy, $testMap);

    expect($map)->toBeInstanceOf(Map::class);
});


it('can flip a map correctly', function () use ($strategy, $testMap) {
    $expectedMap = Map::fromString($strategy, <<<MAP
#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##
MAP);
    $map = Map::fromString($strategy, $testMap);

    expect($map->flip()->matches($expectedMap))->toBeTrue();
});


it('matches the correct state for 2 flips', function () use ($strategy, $testMap) {
    $expectedMap = Map::fromString($strategy, <<<MAP
#.LL.L#.##
#LLLLLL.L#
L.L.L..L..
#LLL.LL.L#
#.LL.LL.LL
#.LLLL#.##
..L.L.....
#LLLLLLLL#
#.LLLLLL.L
#.#LLLL.##
MAP);
    $map = Map::fromString($strategy, <<<MAP
#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##
MAP);

    expect($map->flip()->matches($expectedMap))->toBeTrue();
});


it('matches the correct state for 3 flips', function () use ($strategy, $testMap) {
    $expectedMap = Map::fromString($strategy, <<<MAP
#.##.L#.##
#L###LL.L#
L.#.#..#..
#L##.##.L#
#.##.LL.LL
#.###L#.##
..#.#.....
#L######L#
#.LL###L.L
#.#L###.##
MAP);
    $map = Map::fromString($strategy, <<<MAP
#.LL.L#.##
#LLLLLL.L#
L.L.L..L..
#LLL.LL.L#
#.LL.LL.LL
#.LLLL#.##
..L.L.....
#LLLLLLLL#
#.LLLLLL.L
#.#LLLL.##
MAP);

    expect($map->flip()->matches($expectedMap))->toBeTrue();
});
