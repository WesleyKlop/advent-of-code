<?php


namespace App\Solvers\Y2020\Day4;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    private Collection $passports;

    public function __construct(PassportFactory $passportFactory)
    {
        $this->passports = $passportFactory->fromStringable($this->read('2020', '4'));
    }

    private function getPassports(): Collection
    {
        return $this->passports;
    }

    protected function solvePartOne(): Solution
    {
        $validator = new RequiredFieldsFilledPassportValidator();
        $validPassports = $this
            ->getPassports()
            ->filter(fn (Passport $passport) => $validator->validate($passport))
            ->count();

        return new PrimitiveValueSolution($validPassports);
    }

    protected function solvePartTwo(): Solution
    {
        $validator = new RequiredFieldsValidPassportValidator();
        $validPassports = $this
            ->getPassports()
            ->filter(fn (Passport $passport) => $validator->validate($passport))
            ->count();

        return new TodoSolution();
    }
}
