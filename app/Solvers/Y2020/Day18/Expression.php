<?php


namespace App\Solvers\Y2020\Day18;

use SplQueue;
use SplStack;

class Expression
{
    public function __construct(
        private SplQueue $expressions,
    ) {
    }

    public function solve(): int
    {
        $stack = new SplStack();
        foreach ($this->expressions as $token) {
            match ($token) {
                '*' => $stack->push(
                    $stack->pop() * $stack->pop()
                ),
                '+' => $stack->push(
                    $stack->pop() + $stack->pop()
                ),
                default => $stack->push($token),
            };
        }

        return $stack->pop();
    }
}
