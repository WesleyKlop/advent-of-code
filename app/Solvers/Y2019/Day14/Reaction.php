<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day14;

use Illuminate\Support\Str;

class Reaction
{
    private Chemical $output;

    /**
     * @var Chemical[]
     */
    private array $inputs;

    private bool $isBaseReaction;

    public function __construct(string $reaction)
    {
        [$input, $output] = explode(' => ', $reaction);
        $this->output = new Chemical($output);
        $this->inputs = Str::of($input)
            ->explode(', ')
            ->mapInto(Chemical::class)
            ->all();

        $this->isBaseReaction = $this->inputs[0]->isBaseChemical();
    }

    public function getInputs(): array
    {
        return $this->inputs;
    }

    public function getOutput(): Chemical
    {
        return $this->output;
    }

    public function canProduce(string $type, int $amount): bool
    {
        return $this->getOutput()->getType() === $type
            && ($this->getOutput()->getAmount() <= $amount || $this->isBaseReaction);
    }

    /**
     * @return array<string, int|array<string, int>>
     */
    public function revert(int $input): array
    {
        $requiredForOutput = $this->getOutput()->getAmount();
        $result = [
            'remaining' => $input,
            'output' => [],
        ];

        // How many times can we do this reaction given this input? In case of ORE it's at least one reaction.
        $amountOfReactions = (int) floor($input / $requiredForOutput);
        if ($amountOfReactions === 0 && $this->isBaseReaction) {
            $amountOfReactions = 1;
        }

        $result['remaining'] = $input - ($amountOfReactions * $requiredForOutput);

        foreach ($this->getInputs() as $chemical) {
            $result['output'][$chemical->getType()] = $chemical->getAmount() * $amountOfReactions;
        }

        return $result;
    }
}
