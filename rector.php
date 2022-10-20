<?php

declare(strict_types=1);

use Rector\Set\ValueObject\LevelSetList;

return static function (\Rector\Config\RectorConfig $rectorConfig): void {
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81
    ]);

    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/tests',
        __DIR__ . '/ecs.php',
        __DIR__ . '/rector.php',
        __DIR__ . '/advent-of-code',
    ]);

    $rectorConfig->skip([
        \Rector\Php70\Rector\StaticCall\StaticCallOnNonStaticToInstanceCallRector::class,
        \Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector::class,
    ]);

    $rectorConfig->importNames(
        importNames: false,
        importDocBlockNames: true
    );
    $rectorConfig->importShortClasses(importShortClasses: true);
};
