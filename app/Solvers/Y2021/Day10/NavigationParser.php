<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day10;

use Illuminate\Support\Collection;

class NavigationParser
{
    final public const SYNTAX_ERROR_SCORE = [
        ')' => 3,
        ']' => 57,
        '}' => 1197,
        '>' => 25137,
    ];

    final public const AUTOCOMPLETE_SCORE = [
        ')' => 1,
        ']' => 2,
        '}' => 3,
        '>' => 4,
    ];

    final public const MATCH_TAGS = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
        '<' => '>',
    ];

    private \SplStack $expectedClosingTags;

    public function __construct()
    {
        $this->expectedClosingTags = new \SplStack();
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

    public function calculateAutocompleteScores(Collection $lines): array
    {
        $score = [];
        foreach ($lines as $line) {
            $this->clearStack();
            if ($this->isCorruptedLine($line)) {
                continue;
            }
            $score[] = $this->fixIncompleteLine();
        }
        sort($score);
        return $score;
    }

    protected function isClosingTag(string $char): bool
    {
        return in_array($char, self::MATCH_TAGS, true);
    }

    private function parse(string $char): int
    {
        if (! $this->isClosingTag($char)) {
            $this->expectedClosingTags->push(self::MATCH_TAGS[$char]);
            return 0;
        }

        if ($this->expectedClosingTags->isEmpty()) {
            return self::SYNTAX_ERROR_SCORE[$char];
        }
        $expectedClosingTag = $this->expectedClosingTags->pop();
        if ($expectedClosingTag !== $char) {
            return self::SYNTAX_ERROR_SCORE[$char];
        }
        return 0;
    }

    private function clearStack(): void
    {
        $this->expectedClosingTags = new \SplStack();
    }

    private function isCorruptedLine($line): bool
    {
        foreach (str_split($line) as $char) {
            if ($this->parse($char) > 0) {
                return true;
            }
        }
        return false;
    }

    private function fixIncompleteLine(): int
    {
        $score = 0;
        while ($this->expectedClosingTags->count() > 0) {
            $char = $this->expectedClosingTags->pop();
            $score = (int) ($score * 5);
            $score += self::AUTOCOMPLETE_SCORE[$char];
        }
        return $score;
    }
}
