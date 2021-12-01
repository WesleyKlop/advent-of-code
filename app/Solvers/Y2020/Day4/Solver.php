<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day4;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    public function __construct(
        private PassportValidator $validator
    ) {
    }

    protected function solvePartOne(): Solution
    {
        $passports = $this->getPassports();

        $validPassports = $passports
            ->filter(fn (Collection $passport) => $this->validator->validateRequiredFieldsExist($passport))
            ->count();

        return new PrimitiveValueSolution($validPassports);
    }

    protected function solvePartTwo(): Solution
    {
        $passports = $this->getPassports();

        $validPassports = $passports
            ->filter(fn (Collection $passport) => $this->validator->validateRequiredFieldsValid($passport))
            ->count();

        return new PrimitiveValueSolution($validPassports);
    }

    private function getPassports(): Collection
    {
        return $this->read('2020', '4')
            ->explode("\n\n")
            ->map(fn (string $passport) => Str
                ::of($passport)
                    ->split("/\n| /")
                    ->mapWithKeys(function (string $passport) {
                        [$key, $value] = explode(':', $passport);
                        if ($key === 'hgt') {
                            $isInches = Str::endsWith($value, 'in');
                            $value = (int) substr($value, 0, -2);
                            $value = $isInches ? $value * 2.54 : $value;
                        }
                        return [
                            $key => $value,
                        ];
                    }));
    }
}
