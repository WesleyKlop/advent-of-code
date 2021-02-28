<?php


namespace App\Solvers\Y2020\Day18;

use Illuminate\Support\Str;
use SplQueue;
use SplStack;

class PostfixExpression
{
    private function __construct(
        private SplQueue $expressions,
    ) {
    }

    public static function fromString(string $expression): static
    {
        $tokens = Str::of($expression)
            ->explode(' ')
            ->flatMap(function (string $token) {
                // We want the parenthesis as separate tokens to use some regex magic.
                preg_match("/^(.*)?(\d+|\*|\+)(.*)?$/", $token, $matches);
                return [
                    ...str_split($matches[1]), // Left parenthesis
                    $matches[2], // Value or Operator
                    ...str_split($matches[3]), // Right parenthesis
                ];
            })
            ->filter() // Remove empty strings
            ->all();
        return static::fromTokens($tokens);
    }

    /**
     * Use Dijkstra's shunting yard algorithm for converting to Postfix
     */
    protected static function fromTokens(array $tokens): static
    {
        $operators = new SplStack();
        $output = new SplQueue();
        while ($token = array_shift($tokens)) {
            if (is_numeric($token)) {
                $output->push($token);
                continue;
            }
            if (in_array($token, ['*', '+'])) {
                while (!$operators->isEmpty() && $operators->top() !== '(') {
                    $output->push($operators->pop());
                }
                $operators->push($token);
            }
            if ($token === '(') {
                $operators->push($token);
                continue;
            }
            if ($token === ')') {
                while ($operators->top() !== '(') {
                    $output->push($operators->pop());
                }
                if ($operators->top() === '(') {
                    $operators->pop();
                }
                continue;
            }
        }

        while (!$operators->isEmpty()) {
            $output->push($operators->pop());
        }

        return new static($output);
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
