<?php


namespace App\Solvers\Y2020\Day4;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    private static array $REQUIRED_KEYS = [];


    public function __construct()
    {
        static::$REQUIRED_KEYS = [
            'byr' => fn (int $year) => ($year >= 1920 && $year <= 2002),
            'iyr' => fn (int $year) => ($year >= 2010 && $year <= 2020),
            'eyr' => fn (int $year) => ($year >= 2020 && $year <= 2030),
            'hgt' => fn (string $height) => ($height >= 150 && $height <= 193),
            'hcl' => fn (string $hairColor) => preg_match("/^#[a-f0-9]{6}$/", $hairColor) === 1,
            'ecl' => fn (string $eyeColor) => in_array($eyeColor, explode(' ', 'amb blu brn gry grn hzl oth')),
            'pid' => fn (string $pid) => preg_match("/^\d{9}$/", $pid) === 1,
        ];
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
                        if (!Str::endsWith($value, ['in', 'cm'])) {
                            return [];
                        }
                        if (Str::endsWith($value, 'in')) {
                            $value = round(substr($value, 0, -2) * 2.54);
                        }
                        if (Str::endsWith($value, 'cm')) {
                            $value = substr($value, 0, -2);
                        }
                    }
                    return [$key => $value];
                }));
    }

    protected function solvePartOne(): Solution
    {
        $passports = $this->getPassports();

        $validPassports = $passports->filter(function (Collection $passport) {
            foreach (array_keys(static::$REQUIRED_KEYS) as $key) {
                if (!$passport->has($key)) {
                    return false;
                }
            }
            return true;
        })
        ->count();

        return new PrimitiveValueSolution($validPassports);
    }

    protected function solvePartTwo(): Solution
    {
        $passports = $this->getPassports();

        $validPassports = $passports->filter(function (Collection $passport) {
            foreach (static::$REQUIRED_KEYS as $key => $validator) {
                if (!$passport->has($key) || !$validator($passport->get($key))) {
                    return false;
                }
            }
            return true;
        })
            ->count();

        return new PrimitiveValueSolution($validPassports);
    }
}
