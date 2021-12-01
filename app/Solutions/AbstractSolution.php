<?php

declare(strict_types=1);

namespace App\Solutions;

use App\Contracts\Solution;
use Symfony\Component\Console\Output\OutputInterface as Output;

abstract class AbstractSolution implements Solution
{
    private int $year;

    private int $day;

    private int $part;

    public function setMeta(int $year, int $day, int $part): void
    {
        $this->year = $year;
        $this->day = $day;
        $this->part = $part;
    }

    protected function displayInfo(Output $output): void
    {
        $output->write('<info>');
        if ($output->getVerbosity() >= Output::VERBOSITY_VERY_VERBOSE) {
            $output->write("[Y{$this->year}]");
        }
        if ($output->getVerbosity() >= Output::VERBOSITY_VERBOSE) {
            $output->write("[D{$this->day}]");
        }
        if ($output->getVerbosity() >= Output::VERBOSITY_NORMAL) {
            $output->write("[P{$this->part}] ");
        }
        $output->write('</info>');
    }
}
