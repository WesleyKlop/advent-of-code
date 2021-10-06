<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day14;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use App\Solvers\UsesInput;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    use UsesInput;

    protected function solvePartOne(): Solution
    {
        $reactions = $this->getReactions();
        $inventory = collect([
            Chemical::FUEL => 1,
        ]);

        $factory = new NanoFactory($reactions);

        $result = $factory->process($inventory);
        return new PrimitiveValueSolution($result);
    }

    protected function solvePartTwo(): Solution
    {
        return new PrimitiveValueSolution(0);
    }

    private function getReactions(): Collection
    {
        return ReactionFactory::fromStringable($this->read('2019', '14'));
    }
}
