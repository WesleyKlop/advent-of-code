<?php


namespace App\Solvers\Y2020\Day4;

use Illuminate\Support\Collection;

class PassportValidator
{
    private Collection $validators;

    public function __construct()
    {
        $this->validators = $this->createValidators();
    }

    public function validateRequiredFieldsExist(Collection $passport): bool
    {
        return $this
            ->validators
            ->keys()
            ->every(fn (string $key) => $passport->has($key));
    }

    public function validateRequiredFieldsValid(Collection $passport): bool
    {
        return $this
            ->validators
            ->every(fn (callable $validator, string $key) => $passport->has($key) && $validator($passport->get($key)));
    }

    private function createValidators(): Collection
    {
        return collect([
            'byr' => fn (int $year) => ($year >= 1920 && $year <= 2002),
            'iyr' => fn (int $year) => ($year >= 2010 && $year <= 2020),
            'eyr' => fn (int $year) => ($year >= 2020 && $year <= 2030),
            'hgt' => fn (int $height) => ($height >= 150 && $height <= 193),
            'hcl' => fn (string $hairColor) => preg_match("/^#[a-f0-9]{6}$/", $hairColor) === 1,
            'ecl' => fn (string $eyeColor) => in_array($eyeColor, explode(' ', 'amb blu brn gry grn hzl oth')),
            'pid' => fn (string $pid) => preg_match("/^\d{9}$/", $pid) === 1,
        ]);
    }
}
