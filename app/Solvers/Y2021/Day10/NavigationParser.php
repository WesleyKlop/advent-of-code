<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day10;

use Illuminate\Support\Collection;

class NavigationParser
{
    final public const SCORE_TABLE = [
        ')' => 3,
        ']' => 57,
        '}' => 1197,
        '>' => 25137,
    ];

    final public const MATCH_TAGS = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
        '<' => '>',
    ];

    private \SplStack $expectedClosingTag;

    public function __construct()
    {
        $this->expectedClosingTag = new \SplStack();
    }

    public function calculateSyntaxErrorScore(Collection $lines): int
    {
        $score = 0;
        foreach ($lines as $line) {
            foreach (str_split($line) as $char) {
                $score += $this->parse($char);
            }
            $this->clearStack();
        }
        return $score;
    }

    protected function isClosingTag(string $char): bool
    {
        return in_array($char, self::MATCH_TAGS, true);
    }

    private function parse(string $char): int
    {
        if (! $this->isClosingTag($char)) {
            $this->expectedClosingTag->push(self::MATCH_TAGS[$char]);
            return 0;
        }

        if ($this->expectedClosingTag->isEmpty()) {
            return self::SCORE_TABLE[$char];
        }
        $expectedClosingTag = $this->expectedClosingTag->pop();
        if ($expectedClosingTag !== $char) {
            return self::SCORE_TABLE[$char];
        }
        return 0;
    }

    private function clearStack(): void
    {
        $this->expectedClosingTag = new \SplStack();
    }
}
