<?php


namespace App\Solvers\Y2020\Day4;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    private PassportValidator $validator;

    public function __construct(PassportValidator $validator)
    {
        $this->validator = $validator;
    }

    private function getPassports(): Collection
    {
        return $this->read('2020', '4')
            ->explode("\n\n")
            ->map(fn (string $passport) => Str
                ::of($passport)
                ->split("/\n| /")
                ->mapWithKeys(function (string $passport) {
                    [$key, $value] = explode(":", $passport);
                    if ($key === 'hgt') {
                        $isInches = Str::endsWith($value, 'in');
                        $value = (int)substr($value, 0, -2);
                        $value = $isInches ? $value * 2.54 : $value;
                    }
                    return [$key => $value];
                }));
    }

    protected function solvePartOne(): Solution
    {
        $passports = $this->getPassports();

        $validPassports = $passports
            ->filter(function (Collection $passport) {
                return $this->validator->validateRequiredFieldsExist($passport);
            })
            ->count();

        return new PrimitiveValueSolution($validPassports);
    }

    protected function solvePartTwo(): Solution
    {
        $passports = $this->getPassports();

        $validPassports = $passports
            ->filter(function (Collection $passport) {
                return $this->validator->validateRequiredFieldsValid($passport);
            })
            ->count();

        return new PrimitiveValueSolution($validPassports);
    }
}
