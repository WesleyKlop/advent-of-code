<?php


namespace App\Solutions;


use App\Contracts\Solution;
use Symfony\Component\Console\Output\OutputInterface as Output;

abstract class AbstractSolution implements Solution
{
    private string $year;
    private string $day;
    private string $part;

    protected function displayInfo(Output $output): void
    {
        $output->write("<info>");
        if ($output->getVerbosity() >= Output::VERBOSITY_VERY_VERBOSE) {
            $output->write("[Y{$this->year}]");
        }
        if ($output->getVerbosity() >= Output::VERBOSITY_VERBOSE) {
            $output->write("[D{$this->day}]");
        }
        if ($output->getVerbosity() >= Output::VERBOSITY_NORMAL) {
            $output->write("[P{$this->part}] ");
        }
        $output->write("</info>");
    }

    public function setMeta(string $year, string $day, string $part): void
    {
        $this->year = $year;
        $this->day = $day;
        $this->part = $part;
    }
}
