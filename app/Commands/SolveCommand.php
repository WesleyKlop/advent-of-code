<?php

namespace App\Commands;

use App\Contracts\AcceptsArguments;
use App\Factories\SolverFactory;
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
     * @return int
     */
    public function handle(SolverFactory $solverFactory): int
    {
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
