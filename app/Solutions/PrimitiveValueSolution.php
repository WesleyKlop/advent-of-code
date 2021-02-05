<?php


namespace App\Solutions;

use Symfony\Component\Console\Output\OutputInterface;

class PrimitiveValueSolution extends AbstractSolution
{
    protected string | iterable | null $value;

    public function __construct(string | iterable | null $value)
    {
        $this->value = $value;
    }

    public function display(OutputInterface $output): void
    {
        $this->displayInfo($output);
        $output->write("Solution: ");
        $output->writeln($this->value);
    }

    public function value(): iterable | null | string
    {
        return $this->value;
    }
}
