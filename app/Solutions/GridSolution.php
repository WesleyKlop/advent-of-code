<?php

declare(strict_types=1);

namespace App\Solutions;

use Symfony\Component\Console\Output\OutputInterface;

class GridSolution extends AbstractSolution
{
    public function __construct(
        private int $solution,
        private array $grid
    ) {
    }

    public function display(OutputInterface $output): void
    {
        $this->displayInfo($output);

        $output->writeln('Grid: ');
        $output->write($this->printGrid());

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
                $output .= $this->grid[$x][$y] ?? '.';
            }
            $output .= "\n";
        }
        return $output;
    }
}
