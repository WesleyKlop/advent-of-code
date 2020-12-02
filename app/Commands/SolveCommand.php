<?php

namespace App\Commands;

use App\Contracts\AcceptsArguments;
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
    protected $signature = 'solve {--year=2020} {--part=} {day} {arguments?*}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Solve the puzzle for a given day.';

    /**
     * Execute the console command.
     *
     * @param SolverFactory $solverFactory
     * @param AdventOfCodeApiClient $apiClient
     * @return int
     */
    public function handle(SolverFactory $solverFactory, AdventOfCodeApiClient $apiClient): int
    {
        $year = $this->option('year') ?? env('DEFAULT_YEAR');
        $day = $this->argument('day') ?? env('DEFAULT_DAY');

        // Make sure we have input to work with.
        $apiClient->fetchInputIfNotExists($year, $day);

        $solver = $solverFactory->make($year, $day);

        if ($solver instanceof AcceptsArguments) {
            $solver->acceptArguments($this->argument('arguments'));
        }

        foreach (collect($this->option('part') ?? [1, 2]) as $part) {
            $solution = $solver->solve($part);

            $solution->setMeta($year, $day, $part);
            $solution->display($this->getOutput());
        }

        return 0;
    }
}
