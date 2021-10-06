<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day6;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $uniqueAnswersPerGroup = $this
            ->read('2020', '6')
            ->explode("\n\n")
            ->map(function (string $group) {
                // Map each group to members with an array of their given answers.
                return Str
                    ::of($group)
                        ->explode("\n")
                        ->map(fn (string $answers) => str_split($answers))
                    // Map a dictionary containing the keys of every answer given
                        ->flatten()
                        ->flip();
            })
            ->sum(fn (Collection $group) => $group->count());

        return new PrimitiveValueSolution($uniqueAnswersPerGroup);
    }

    protected function solvePartTwo(): Solution
    {
        $uniqueAnswersPerGroup = $this
            ->read('2020', '6')
            ->explode("\n\n")
            // Create a dictionary containing answers that everyone answers yes to
            ->map(fn (string $group) => Str::of($group)
            ->explode("\n")
                // Create a dictionary containing answers that everyone answers yes to
            ->map(fn (string $answers) => str_split($answers))
            ->reduce(fn (
                ?Collection $group,
                array $member
            ) => $group === null ? collect($member) : $group->intersect($member)))
            ->sum(fn (Collection $group) => $group->count());

        return new PrimitiveValueSolution($uniqueAnswersPerGroup);
    }
}
