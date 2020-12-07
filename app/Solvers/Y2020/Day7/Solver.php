<?php


namespace App\Solvers\Y2020\Day7;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    protected function parseRules(): Collection
    {
        return $this
            ->readLazy('2020', '7')
            ->map(fn (string $line) => Str::of($line)->explode(' contain '))
            ->map(fn (Collection $bagHolds) => Bag::collect($bagHolds->first(), explode(', ', $bagHolds->last())))
            ->collect();
    }

    protected function solvePartOne(): Solution
    {
        $bagRules = $this->parseRulesIntoGraph();

        $bagsThatCanContainShinyGold = collect([]);
        $shinyGoldBag = new Bag('shiny', 'gold');

        /** @var Bag $bagRule */
        foreach ($bagRules as $key => $bagRule) {
            if ($bagRule->canContain($shinyGoldBag)) {
                $bagsThatCanContainShinyGold->put($key, null);
            }
        }

        return new PrimitiveValueSolution($bagsThatCanContainShinyGold->count());
    }

    protected function solvePartTwo(): Solution
    {
        $graph = $this->parseRulesIntoGraph();

        /** @var Bag $shinyGoldBag */
        $shinyGoldBag = $graph->get('shiny gold');

        return new PrimitiveValueSolution($shinyGoldBag->aggregate() - 1);
    }

    private function parseRulesIntoGraph(): Collection
    {
        $rules = $this
            ->parseRules()
            ->keyBy(fn (Bag $bag) => $bag->getKey());
        return $rules
            ->transform(fn (Bag $bag) => $bag->link($rules));
    }
}
