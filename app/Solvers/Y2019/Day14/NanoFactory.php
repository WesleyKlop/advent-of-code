<?php


namespace App\Solvers\Y2019\Day14;

use Illuminate\Support\Collection;

class NanoFactory
{
    private Collection $reactions;

    public function __construct(Collection $reactions)
    {
        $this->reactions = $reactions;
    }

    public function process(Collection $inventory): Collection
    {
        foreach ($inventory as $type => $amount) {
            // Into what input can we break down our output chemical?
            $reaction = $this->getReactionThatProduces($type, $amount);

            if (is_null($reaction)) {
                dump("Can not break down $amount $type yet");
                continue;
            }

            // Revert the reaction as many times as we can with our given input.
            $result = $reaction->revert($amount);

            $inventory->put($type, $result['remaining']);

            if ($result['remaining'] === 0) {
                $inventory->offsetUnset($type);
            }

            foreach ($result['output'] as $outType => $outAmount) {
                $inventory->put($outType, $inventory->get($outType, 0) + $outAmount);
            }

            return $this->process($inventory);
        }

        return $inventory;
    }

    public function getReactionThatProduces(string $type, int $amount): ?Reaction
    {
        if ($type === Chemical::ORE) {
            return null;
        }

        return $this
            ->reactions
            ->first(
                fn (Reaction $reaction) => $reaction->canProduce($type, $amount)
            );
    }
}
