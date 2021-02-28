<?php


namespace App\Solvers\Y2020\Day18;

use SplQueue;
use SplStack;

class PartTwoTokenParser extends TokenParser
{
    public static function fromTokens(array $tokens): Expression
    {
        $operators = new SplStack();
        $output = new SplQueue();

        while ($token = array_shift($tokens)) {
            if (is_numeric($token)) {
                $output->push($token);
                continue;
            }
            if (in_array($token, ['*', '+'])) {
                while (!$operators->isEmpty() && !in_array($operators->top(), ['(', '*'])) {
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

        return new Expression($output);
    }
}
