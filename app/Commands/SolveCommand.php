<?php

declare(strict_types=1);

namespace App\Commands;

use App\Contracts\AcceptsArguments;
use App\Contracts\HasProgressBar;
use App\Exceptions\ApplicationException;
use App\Factories\SolverFactory;
use App\Http\Client\AdventOfCodeApiClient;
use LaravelZero\Framework\Commands\Command;

class SolveCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'solve
        {--year=2021 : Year to look for the solver}
        {--part= : The part to solve, defaults to both}
        {--fetch : If we want to fetch the input from the AoC website}
        {day : Day to solve}
        {arguments?* : Extra arguments}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Solve the puzzle for a given day.';

    /**
     * Execute the console command.
     */
    public function handle(SolverFactory $solverFactory, AdventOfCodeApiClient $apiClient): int
    {
        $year = $this->option('year') ?? env('DEFAULT_YEAR');
        $day = $this->argument('day') ?? env('DEFAULT_DAY');

        if ($this->option('fetch')) {
            // Make sure we have input to work with.
            $apiClient->fetchInput($year, $day);
        }

        try {
            $solver = $solverFactory->make($year, $day);
        } catch (ApplicationException $reee) {
            $this->error($reee->getMessage());
            return 1;
        }

        if ($solver instanceof AcceptsArguments) {
            $solver->acceptArguments($this->argument('arguments'));
        }

        if ($solver instanceof HasProgressBar) {
            $solver->setProgressBar($this->getOutput()->createProgressBar());
        }

        foreach (collect($this->option('part') ?? [1, 2]) as $part) {
            $solution = $solver->solve($part);

            $solution->setMeta($year, $day, $part);
            $solution->display($this->getOutput());
        }

        return 0;
    }
}
