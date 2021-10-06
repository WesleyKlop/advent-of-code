<?php

declare(strict_types=1);

namespace App\Solutions;

use Symfony\Component\Console\Output\OutputInterface;

class PrimitiveValueSolution extends AbstractSolution
{
    public function __construct(
        protected int | string | iterable | null $value
    ) {
    }

    public function display(OutputInterface $output): void
    {
        $this->displayInfo($output);
        $output->write('Solution: ');
        $output->writeln($this->value);
    }

    public function value(): iterable | null | string | int
    {
        return $this->value;
    }
}
