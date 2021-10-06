<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day18;

use Illuminate\Support\Str;

abstract class TokenParser
{
    public static function fromString(string $expression): Expression
    {
        $tokens = static::parseExpression($expression);
        return static::fromTokens($tokens);
    }

    abstract public static function fromTokens(array $tokens): Expression;

    protected static function parseExpression(string $expression): array
    {
        return Str::of($expression)
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
            ->filter() // Remove empty tokens
            ->all();
    }
}
