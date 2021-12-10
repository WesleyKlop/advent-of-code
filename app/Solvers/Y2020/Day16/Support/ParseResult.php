<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day16\Support;

use Illuminate\Support\Collection;

class ParseResult
{
    public function __construct(
        private readonly Collection $rules,
        private readonly Ticket $yourTicket,
        private readonly Collection $nearbyTickets
    ) {
    }

    public function getYourTicket(): Ticket
    {
        return $this->yourTicket;
    }

    public function getNearbyTickets(): Collection
    {
        return $this->nearbyTickets;
    }

    public function getConstraints(): Collection
    {
        return $this->rules;
    }
}
