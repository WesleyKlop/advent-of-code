<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day16\Support;

use App\Solvers\Y2020\Day16\Constraints\Constraint;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class InputParser
{
    public function fromStringable(Stringable $input): ParseResult
    {
        [$constraints, $yourTicket, $nearbyTickets] = $input->explode("\n\n");

        return new ParseResult(
            rules: $this->parseConstraints($constraints),
            yourTicket: $this->parseTicketList($yourTicket)->first(),
            nearbyTickets: $this->parseTicketList($nearbyTickets),
        );
    }

    private function parseConstraints(string $constraints): Collection
    {
        return Str::of($constraints)
            ->explode("\n")
            ->map(fn (string $line) => Constraint::fromString($line));
    }

    private function parseTicketList(string $yourTicket): Collection
    {
        return Str::of($yourTicket)
            ->explode("\n")
            ->skip(1)
            ->map(fn (string $line) => explode(',', $line))
            ->map(fn (array $line) => new Ticket($line));
    }
}
