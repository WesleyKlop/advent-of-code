<?php


namespace App\Solvers\Y2020\Day1;


use App\Contracts\Solution;
use App\Exceptions\AnswerNotFoundException;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use App\Solvers\UsesInput;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    use UsesInput;


    protected function solvePartOne(): Solution
    {
        $input = $this->getInput();

        foreach ($input as $outer) {
            foreach($input as $inner) {
                if($outer + $inner !== 2020) {
                    continue;
                }
                return new PrimitiveValueSolution($outer * $inner);
            }
        }

        throw new AnswerNotFoundException();
    }

    protected function solvePartTwo(): Solution
    {
        $input = $this->getInput();

        foreach ($input as $outer) {
            foreach ($input as $inner) {
                foreach($input as $middle) {
                    if($outer + $inner + $middle === 2020) {
                        return new PrimitiveValueSolution($outer * $inner * $middle);
                    }
                }
            }
        }

        throw new AnswerNotFoundException();
    }

    private function getInput(): Collection
    {
        return $this->input('2020', '1')->explode("\n");
    }

}
