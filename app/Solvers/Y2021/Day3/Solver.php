<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day3;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $gamma = '';
        $epsilon = '';
        $input = $this->getInput();
        $lineWidth = mb_strlen($input->first());
        $lineCount = $input->count();

        foreach (range(0, $lineWidth - 1) as $i) {
            $oneCount = 0;
            foreach ($input as $line) {
                if ($line[$i] === '1') {
                    $oneCount++;
                }
            }
            if ($oneCount > $lineCount / 2) {
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
        $input = $this->getInput();
        $oxygenGeneratorRatingIndexes = array_flip(range(0, $input->count() - 1));
        $co2ScrubberRatingIndexes = array_flip(range(0, $input->count() - 1));
        $currentIdx = 0;

        while (true) {
            if (count($oxygenGeneratorRatingIndexes) === 1 && count($co2ScrubberRatingIndexes) === 1) {
                break;
            }
            if (count($oxygenGeneratorRatingIndexes) > 1) {
                $indexesWithOne = [];
                foreach ($oxygenGeneratorRatingIndexes as $index) {
                    if ($input[$index][$currentIdx] === '1') {
                        $indexesWithOne[$index] = true;
                    }
                }
                if (count($indexesWithOne) >= count($oxygenGeneratorRatingIndexes) / 2) {
                    // More than half of the indexes are 1, reject all zeroes
                    $oxygenGeneratorRatingIndexes = array_intersect_key($oxygenGeneratorRatingIndexes, $indexesWithOne);
                } else {
                    // Reject all ones
                    $oxygenGeneratorRatingIndexes = array_diff_key($oxygenGeneratorRatingIndexes, $indexesWithOne);
                }
            }

            if (count($co2ScrubberRatingIndexes) > 1) {
                $indexesWithOne = [];
                foreach ($co2ScrubberRatingIndexes as $index) {
                    if ($input[$index][$currentIdx] === '1') {
                        $indexesWithOne[$index] = true;
                    }
                }
                if (count($indexesWithOne) >= count($co2ScrubberRatingIndexes) / 2) {
                    // More than half of the indexes are 1, reject all ones
                    $co2ScrubberRatingIndexes = array_diff_key($co2ScrubberRatingIndexes, $indexesWithOne);
                } else {
                    // Reject all zeroes
                    $co2ScrubberRatingIndexes = array_intersect_key($co2ScrubberRatingIndexes, $indexesWithOne);
                }
            }

            $currentIdx++;
        }

        $oxygenGeneratorRating = $input->get(reset($oxygenGeneratorRatingIndexes));
        $co2ScrubberRating = $input->get(reset($co2ScrubberRatingIndexes));

        return new PrimitiveValueSolution(
            intval($oxygenGeneratorRating, 2) * intval($co2ScrubberRating, 2),
        );
    }

    private function getInput(): Collection
    {
        return $this
            ->read('2021', '3')
            ->explode("\n");
//            ->map(fn($line) => collect(mb_str_split($line)));
    }
}
