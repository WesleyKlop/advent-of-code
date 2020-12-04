<?php


namespace App\Solvers\Y2020\Day4;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;


class PassportFactory
{

    public function fromStringable(Stringable $passportList): Collection
    {
        return $passportList
            // Passports are separated by 2 newlines.
            ->explode("\n\n")
            ->map(fn(string $passportString) => $this->createPassport($passportString));
    }

    private function createPassport(string $passportString): Passport
    {
        $kv = Str
            ::of($passportString)
            ->split("/[\n :]/")
            ->chunk(2)
            ->mapWithKeys(fn(Collection $pair) => [$pair->first() => $pair->last()]);

        return new Passport(
            $kv['byr'] ?? null,
            $kv['iyr'] ?? null,
            $kv['eyr'] ?? null,
            $kv['hgt'] ?? null,
            $kv['hcl'] ?? null,
            $kv['ecl'] ?? null,
            $kv['pid'] ?? null,
            $kv['cid'] ?? null,
        );
    }
}
