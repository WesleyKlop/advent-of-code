<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\Solver;
use App\Exceptions\ApplicationException;
use Illuminate\Contracts\Container\BindingResolutionException;

class SolverFactory
{
    public function make(string $year, string $day): Solver
    {
        try {
            return app()->make(sprintf('\\App\\Solvers\\Y%s\\Day%s\\Solver', $year, $day));
        } catch (BindingResolutionException $e) {
            throw new ApplicationException(sprintf('There is no solver for year %s day %s', $year, $day), 0, $e);
        }
    }
}
