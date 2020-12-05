<?php


namespace App\Solvers\Y2020\Day4;

interface PassportValidator
{
    public function validate(Passport $passport): bool;
}
