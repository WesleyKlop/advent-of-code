<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day19;

use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Str;

class RuleCollection
{
    private function __construct(
        private readonly Collection $list
    ) {
    }

    public static function parseList(Collection $list): static
    {
        $list = $list->mapWithKeys(function (string $line) {
            [$id, $rules] = explode(': ', $line);
            return [
                $id => $rules,
            ];
        });
        return new static($list);
    }

    public function getRule(int $idx): Rule
    {
        $rule = $this->list->get($idx);
        if (! $rule instanceof Rule) {
            $rule = $this->resolveRule($idx);
        }
        return $rule;
    }

    private function parseRule(string $rules): Rule
    {
        $andGroups = Str::of($rules)
            ->explode(' | ')
            ->map(fn (string $andGroup) => Str::of($andGroup)->explode(' '))
            ->map(fn (Enumerable $andGroup) => $andGroup->map(
                fn (string $rule) => $this->parseRuleValue($rule)
            ))
            ->map(function (Enumerable $andGroup) {
                if ($andGroup->count() === 1) {
                    return $andGroup->first();
                }
                return new AndRule($andGroup->all());
            })
            ->all();

        if (count($andGroups) === 1) {
            return reset($andGroups);
        }

        return new OrRule($andGroups);
    }

    private function parseRuleValue(string $rule): Rule
    {
        if (is_numeric($rule)) {
            $wantedRule = $this->list->get($rule);
            if (is_string($wantedRule)) {
                $this->list->put($rule, $wantedRule = $this->parseRule($wantedRule));
            }
            return $wantedRule;
        }

        return new StringRule(str_replace('"', '', $rule));
    }

    private function resolveRule(int $idx): Rule
    {
        $rule = $this->parseRule($this->list->get($idx));
        $this->list->put($idx, $rule);
        return $rule;
    }
}
