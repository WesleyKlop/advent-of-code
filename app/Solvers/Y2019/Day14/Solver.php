<?php


namespace App\Solvers\Y2019\Day14;


use App\Contracts\Solution;
use App\Solvers\AbstractSolver;
use App\Solvers\UsesInput;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    use UsesInput;

    private function getReactions(): Collection {
        return ReactionFactory::fromStringable($this->read('2019', '14'));
    }

    protected function solvePartOne(): Solution
    {
        $reactions = $this->getReactions();
        $inventory = collect([
            Chemical::FUEL => 1,
        ]);

        $factory = new NanoFactory($reactions);


        $result = $factory->process($inventory);
        // TODO: Implement solvePartOne() method.
    }

    protected function solvePartTwo(): Solution
    {
        // TODO: Implement solvePartTwo() method.
    }
}
