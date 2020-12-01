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
    protected $signature = 'solve {--year=2020} {--part=1} {day} {arguments?*}';

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
        // Make sure we have input to work with.
        $apiClient->fetchInputIfNotExists(
            $this->option('year'),
            $this->argument('day')
        );

        $solver = $solverFactory->make(
            $this->option('year'),
            $this->argument('day')
        );

        if ($solver instanceof AcceptsArguments) {
            $solver->acceptArguments($this->argument('arguments'));
        }

        $solution = $solver->solve($this->option('part'));

        $solution->display($this->getOutput());
        return 0;
    }
}
