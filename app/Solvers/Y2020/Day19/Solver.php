<?php

declare(strict_types=1);


namespace App\Solvers\Y2020\Day19;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    private function getInput(): array
    {
        [$rules, $input] = $this
            ->read('2020', '19')
            ->explode("\n\n");
        return [
            RuleCollection::parseList(Str::of($rules)->explode("\n")),
            Str::of($input)->explode("\n"),
        ];
    }

    protected function solvePartOne(): Solution
    {
        /**
         * @var RuleCollection $rules
         * @var Collection $inputs
         */
        [$rules, $inputs] = $this->getInput();

        $ruleZero = $rules->getRule(0);
        $validPatterns = [...$ruleZero->compile()];

        $result = $inputs
            ->filter(function (string $input) use ($validPatterns) {
                return in_array($input, $validPatterns, true);
            })
            ->count();

        return new PrimitiveValueSolution($result);
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
