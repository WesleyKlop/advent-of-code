<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SETS, [
        SetList::CLEAN_CODE,
        SetList::PSR_12
    ]);

    // Ignore unfinished days
    $parameters->set(Option::SKIP, [
        __DIR__ . '/app/Solvers/Y2020/Day10/*',
        __DIR__ . '/app/Solvers/Y2020/Day12/*',
    ]);
};
