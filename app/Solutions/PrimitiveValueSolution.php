<?php


namespace App\Solutions;


use App\Contracts\Solution;
use Symfony\Component\Console\Output\OutputInterface;

class PrimitiveValueSolution implements Solution
{

    /**
     * @var string|iterable $value
     */
    protected $value;

    /**
     * PrimitiveValueSolution constructor.
     * @param string|iterable $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function display(OutputInterface $output): void
    {
        $output->write("Solution: ");
        $output->writeln($this->value);
    }
}
