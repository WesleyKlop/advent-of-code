<?php


namespace App\Solvers\Y2020\Day16\Constraints;

class OrConstraint extends Constraint
{
    /**
     * @var Constraint[]
     */
    private array $constraints;

    public function __construct(
        Constraint ...$constraints,
    ) {
        $this->constraints = $constraints;
    }

    public function isValid(int $value): bool
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->isValid($value) === true) {
                return true;
            }
        }
        return false;
    }
}
