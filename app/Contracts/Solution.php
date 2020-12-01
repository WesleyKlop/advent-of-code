<?php


namespace App\Contracts;

interface Solution extends Displayable
{
    public function setMeta(string $year, string $day, string $part): void;
}
