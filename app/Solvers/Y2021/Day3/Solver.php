<?php

declare(strict_types=1);


namespace App\Solvers\Y2021\Day3;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    private function getInput(): Collection
    {
        return $this
            ->read('2021', '3')
            ->explode("\n")
            ->map(fn($line) => collect(mb_str_split($line)));
    }

    protected function solvePartOne(): Solution
    {
        $gamma = '';
        $epsilon = '';
        $input = $this->getInput();
        $lineWidth = $input->first()->count();
        $lineCount = $input->count();

        foreach(range(0, $lineWidth - 1) as $i) {
            $oneCount = 0;
            foreach($input as $line) {
                if($line[$i] === '1') {
                    $oneCount++;
                }
            }
            if($oneCount > $lineCount / 2) {
                $gamma .= '1';
                $epsilon .= '0';
            } else {
                $gamma .= '0';
                $epsilon .= '1';
            }
        }

        return new PrimitiveValueSolution(intval($gamma, 2) * intval($epsilon, 2));
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
