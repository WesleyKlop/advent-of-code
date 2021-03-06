<?php

use App\Solvers\Y2020\Day20\Tile;

$strTile = <<<'EOT'
Tile 1337:
01
23
EOT;

$smallArrayTile = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
];
$bigArrayTile = [
    [0, 1, 2, 3, 4],
    [5, 6, 7, 8, 9],
    [10, 11, 12, 13, 14],
    [15, 16, 17, 18, 19],
    [20, 21, 22, 23, 24]
];

it('can create a tile', function (string $strTile) {
    $tile = Tile::fromString($strTile);

    expect($tile)->toBeInstanceOf(Tile::class);
})->with([$strTile]);

it('tile has correct id', function (string $strTile) {
    $tile = Tile::fromString($strTile);

    expect($tile->getId())->toBeInt()->toBe(1337);
})->with([$strTile]);

it('can rotate a tile 90 degrees clockwise', function (array $grid) {
    $tile = new Tile(1337, $grid);

    $tile->rotateRight();
    expect($tile->print())->toBe(<<<'EOT'
20, 15, 10, 5, 0
21, 16, 11, 6, 1
22, 17, 12, 7, 2
23, 18, 13, 8, 3
24, 19, 14, 9, 4
EOT
    );
})->with([[
    $bigArrayTile,
]]);
