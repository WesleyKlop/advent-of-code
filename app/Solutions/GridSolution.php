<?php

declare(strict_types=1);

namespace App\Solutions;

use App\Contracts\DisplayableOnGrid;
use App\Exceptions\ApplicationException;
use Symfony\Component\Console\Output\OutputInterface;

class GridSolution extends AbstractSolution
{
    public function __construct(
        private readonly int $solution,
        private readonly array $grid
    ) {
    }

    public function display(OutputInterface $output): void
    {
        $this->displayInfo($output);
        $output->writeln('Grid: ');
        $output->write($this->printGrid());

        $this->displayInfo($output);
        $output->write('Solution: ');
        $output->writeln($this->value());
    }

    public function value(): int
    {
        return $this->solution;
    }

    private function printGrid(): string
    {
        $output = '';
        $width = range(0, max(array_map('array_key_last', $this->grid)));
        $height = range(0, max(array_keys($this->grid)));
        foreach ($height as $y) {
            foreach ($width as $x) {
                $output .= $this->gridValue($y, $x);
            }
            $output .= "\n";
        }
        return $output;
    }

    private function gridValue(string|int $x, string|int $y): string
    {
        $value = $this->grid[$x][$y] ?? ' ';
        if ($value instanceof DisplayableOnGrid) {
            return $value->character();
        }
        if (is_string($value)) {
            return $value;
        }
        throw new ApplicationException("Invalid value type: {$value}");
    }
}
