<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day16;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use App\Solvers\Y2020\Day16\Constraints\NamedConstraint;
use App\Solvers\Y2020\Day16\Support\InputParser;
use App\Solvers\Y2020\Day16\Support\ParseResult;
use App\Solvers\Y2020\Day16\Support\Ticket;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    public function __construct(
        private InputParser $inputParser
    ) {
    }

    protected function solvePartOne(): Solution
    {
        $info = $this->getInput();
        $constraints = $info->getConstraints();
        $scanningErrorRate = $info
            ->getNearbyTickets()
            ->map(fn (Ticket $ticket) => $ticket->calculateErrorRate($constraints))
            ->sum();

        return new PrimitiveValueSolution($scanningErrorRate);
    }

    protected function solvePartTwo(): Solution
    {
        $info = $this->getInput();
        $constraints = $info->getConstraints();
        $validTickets = $info
            ->getNearbyTickets()
            ->filter(fn (Ticket $ticket) => $ticket->isValid($constraints));

        $possibleMappings = collect([]);

        /** @var NamedConstraint $constraint */
        foreach ($constraints as $constraint) {
            $possibleFields = range(0, $constraints->count() - 1);

            foreach ($possibleFields as $field) {
                if ($validTickets->every->isValidFieldForConstraint($field, $constraint)) {
                    $possibleMappings[$constraint->getName()] = [
                        ...$possibleMappings->get($constraint->getName(), []),
                        $field,
                    ];
                }
            }
        }

        $mapping = [];
        $possibleMappings
            ->sort(fn ($a, $b) => (is_countable($a) ? count($a) : 0) <=> (is_countable($b) ? count($b) : 0))
            ->each(function (array $options, string $field) use (&$mapping) {
                foreach ($options as $option) {
                    if (! isset($mapping[$option])) {
                        $mapping[$option] = $field;
                        break;
                    }
                }
            });

        // Multiply the values of all keys starting with "departure"
        $ticket = $info->getYourTicket()->applyMapping($mapping);

        $answer = 1;
        foreach ($ticket->all() as $key => $value) {
            // There is a single mapping we couldnt't figure out lol
            if (str_starts_with((string) $key, 'departure')) {
                $answer *= $value;
            }
        }

        return new PrimitiveValueSolution($answer);
    }

    private function getInput(): ParseResult
    {
        return $this
            ->inputParser
            ->fromStringable($this->read('2020', '16'));
    }
}
