<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day14;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class ReactionFactory
{
    public static function fromString(string $reactions): Collection
    {
        return static::fromStringable(Str::of($reactions));
    }

    public static function fromStringable(Stringable $reactions): Collection
    {
        return $reactions
            ->split('/\n/')
            ->mapInto(Reaction::class);
    }
}
