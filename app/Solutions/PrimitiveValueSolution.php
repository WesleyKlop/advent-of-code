<?php


namespace App\Solutions;

use App\Contracts\Solution;
use Symfony\Component\Console\Output\OutputInterface;

class PrimitiveValueSolution extends AbstractSolution
{
    /**
     * @var string|iterable|null
     */
    protected $value;

    /**
     * PrimitiveValueSolution constructor.
     * @param string|iterable|null $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function display(OutputInterface $output): void
    {
        $this->displayInfo($output);
        $output->write("Solution: ");
        $output->writeln($this->value);
    }
}
