<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day10;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $parser = new NavigationParser();

        $score = $parser->calculateSyntaxErrorScore($this->getInput());

        return new PrimitiveValueSolution($score);
    }

    protected function solvePartTwo(): Solution
    {
        $parser = new NavigationParser();

        $scores = $parser->calculateAutocompleteScore($this->getInput());

        $middle = (int) floor(count($scores) / 2);

        return new PrimitiveValueSolution($scores[$middle]);
    }

    private function getInput(): Collection
    {
        return $this->read('2021', '10')
            ->explode("\n");
    }
}
