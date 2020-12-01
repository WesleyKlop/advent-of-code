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

        foreach ($input as $id1 => $outer) {
            foreach($input as $id2 => $inner) {
                if($id1 !== $id2 && $outer + $inner === 2020) {
                    return new PrimitiveValueSolution($outer * $inner);
                }
            }
        }

        throw new AnswerNotFoundException();
    }

    protected function solvePartTwo(): Solution
    {
        $input = $this->getInput();

        foreach ($input as $id1 => $outer) {
            foreach ($input as $id2 => $inner) {
                foreach($input as $id3 => $middle) {
                    if($id1 !== $id2 && $id2 !== $id3 && $id1 !== $id3 && $outer + $inner + $middle === 2020) {
                        return new PrimitiveValueSolution($outer * $inner * $middle);
                    }
                }
            }
        }

        throw new AnswerNotFoundException();
    }

    private function getInput(): Collection
    {
        return $this->read('2020', '1')->explode("\n");
    }

}
