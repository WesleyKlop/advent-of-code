<?php

declare(strict_types=1);


namespace App\Solvers\Y2019\Day2;

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
            ->read('2019', '2')
            ->explode(',')
            ->map(fn($value) => (int) $value);
    }

    protected function solvePartOne(): Solution
    {
        $instructionPointer = 0;
        $program = $this->getInput();

        $program->put(1, 12);
        $program->put(2, 2);
        do {
            $opcode = $program->get($instructionPointer);
            [$aAddress, $bAddress, $destinationAddress] = $program->slice($instructionPointer + 1, 3)->values();

            switch ($opcode) {
                case 1:
                    $a = $program->get($aAddress);
                    $b = $program->get($bAddress);
                    $program->put($destinationAddress, $a + $b);
                    break;
                case 2:
                    $a = $program->get($aAddress);
                    $b = $program->get($bAddress);
                    $program->put($destinationAddress, $a * $b);
                    break;
                case 99:
                    // We are finished!
                    break;
                default:
                    throw new \Exception('Unknown opcode: ' . $opcode);
            }
            $instructionPointer += 4;
            dump($program->join(','));
        } while ($opcode !== 99);

        dump($program->join(','));
        return new PrimitiveValueSolution($program->get(0));
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
