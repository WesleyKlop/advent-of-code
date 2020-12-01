<?php


namespace App\Solutions;

use App\Contracts\Solution;
use Symfony\Component\Console\Output\OutputInterface;

class PrimitiveValueSolution implements Solution
{
    /**
     * @var string|iterable
     */
    protected $value;

    private ?string $part = null;

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
        if ($this->part) {
            $output->write("[Part {$this->part}] ");
        }
        $output->write("Solution: ");
        $output->writeln($this->value);
    }

    public function setMeta(string $year, string $day, string $part): void
    {
        $this->part = $part;
    }
}
