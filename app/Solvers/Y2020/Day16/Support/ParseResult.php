<?php


namespace App\Solvers\Y2020\Day16\Support;

use Illuminate\Support\Enumerable;

class ParseResult
{
    public function __construct(
        private Enumerable $rules,
        private Enumerable $yourTicket,
        private Enumerable $nearbyTickets
    ) {
    }

    public function getYourTicket(): Enumerable
    {
        return $this->yourTicket;
    }

    public function getNearbyTickets(): Enumerable
    {
        return $this->nearbyTickets;
    }

    public function getConstraints(): Enumerable
    {
        return $this->rules;
    }
}
