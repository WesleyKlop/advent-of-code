<?php


namespace App\Contracts;


interface AcceptsArguments
{
    public function acceptArguments(array $arguments): void;
}
