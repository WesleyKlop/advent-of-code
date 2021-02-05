<?php


namespace App\Solvers\Y2020\Day16\Support;


use App\Solvers\Y2020\Day16\Constraints\Constraint;
use Illuminate\Support\Enumerable;

class Ticket
{
    /** @var int[] $fields */
    private array $fields;

    public function __construct(
        array $fields
    ) {
        $this->fields = array_map(fn ($val) => (int) $val, $fields);
    }

    public function calculateErrorRate(Enumerable $constraints): int
    {
        foreach ($this->fields as $field) {
            $isValidField = $constraints->some(fn(Constraint $constraint) => $constraint->isValid($field));

            if(! $isValidField) {
                return $field;
            }
        }

        return 0;
    }

    public function isValid(Enumerable $constraints): bool {
        return $this->calculateErrorRate($constraints) === 0;
    }
}
