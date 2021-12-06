<?php

declare(strict_types=1);

namespace App\Commands;

use App\Contracts\AcceptsArguments;
use App\Contracts\HasProgressBar;
use App\DataTransferObjects\SolveConfiguration;
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
        {--year= : Year to look for the solver, defaults to current year}
        {--part= : The part to solve, defaults to both}
        {--fetch : If we want to fetch the input from the AoC website}
        {--test : Use the test.txt instead of input.txt}
        {day? : Day to solve, defaults to today}
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
        $config = SolveConfiguration::parse(
            $this->option('year'),
            $this->argument('day'),
        );

        if ($this->option('fetch')) {
            // Make sure we have input to work with.
            $apiClient->fetchInput(
                $config->year,
                $config->day,
            );
        }

        try {
            $solver = $solverFactory->make($config);
        } catch (ApplicationException $exception) {
            $this->error($exception->getMessage());
            return 1;
        }

        if ($this->option('test')) {
            $solver->useTestInput();
        }

        if ($solver instanceof AcceptsArguments) {
            $solver->acceptArguments($this->argument('arguments'));
        }

        if ($solver instanceof HasProgressBar) {
            $solver->setProgressBar($this->getOutput()->createProgressBar());
        }

        $this->configurePart($config);

        foreach ($config->parts() as $part) {
            $solution = $solver->solve($part);

            $solution->setMeta(
                $config->year,
                $config->day,
                $part
            );
            $solution->display($this->getOutput());
        }

        return 0;
    }

    public function configurePart(SolveConfiguration $config): void
    {
        switch ($this->option('part')) {
            case '1':
                $config->solveOnlyPartOne();
                break;
            case '2':
                $config->solveOnlyPartTwo();
                break;
            default:
                $config->solveBothParts();
        }
    }
}
