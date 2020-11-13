<?php


namespace App\Contracts;


interface Solver
{
    public function solve(string $part): Solution;
}
