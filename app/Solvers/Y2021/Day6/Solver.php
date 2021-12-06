<?php

declare(strict_types=1);


namespace App\Solvers\Y2021\Day6;

use App\Contracts\AcceptsArguments;
use App\Contracts\HasProgressBar;
use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class Solver extends AbstractSolver implements HasProgressBar
{
    private int $simulateDays = 0;
    private ProgressBar $progressBar;

    /** @return Collection */
    private function getInput(): Collection
    {
        return $this
            ->read('2021', '6')
            ->explode(',')
            ->mapInto(LanternFish::class);
    }

    private function simulateLanternFish(): int
    {
        $this->progressBar->start($this->simulateDays);
        $input = $this->getInput();
        for ($i = 1; $i <= $this->simulateDays; $i++) {
            $this->progressBar->advance();
            /** @var LanternFish $fish */
            foreach ($input as $fish) {
                $shouldCreateNewFish = $fish->generation();
                if ($shouldCreateNewFish) {
                    $input->push(new LanternFish());
                }
            }
        }
        $this->progressBar->clear();
        return $input->count();
    }

    protected function solvePartOne(): Solution
    {
        $this->simulateDays = 80;
        return new PrimitiveValueSolution(
            $this->simulateLanternFish()
        );
    }

    protected function solvePartTwo(): Solution
    {
        $this->simulateDays = 256;
        return new PrimitiveValueSolution(
            $this->simulateLanternFish()
        );
    }

    public function setProgressBar(ProgressBar $progressBar): void
    {
        $this->progressBar = $progressBar;
    }
}
