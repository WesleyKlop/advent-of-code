<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\Solver;
use App\DataTransferObjects\SolveConfiguration;
use App\Exceptions\ApplicationException;
use Illuminate\Contracts\Container\BindingResolutionException;

class SolverFactory
{
    public function make(SolveConfiguration $solveConfig): Solver
    {
        try {
            return app(sprintf('\\App\\Solvers\\Y%s\\Day%s\\Solver', $solveConfig->year, $solveConfig->day));
        } catch (BindingResolutionException $e) {
            throw new ApplicationException(sprintf('There is no solver for year %s day %s', $solveConfig->year, $solveConfig->day), 0, $e);
        }
    }
}
