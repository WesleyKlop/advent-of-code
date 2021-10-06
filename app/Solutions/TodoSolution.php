<?php

declare(strict_types=1);

namespace App\Solutions;

use Symfony\Component\Console\Output\OutputInterface;

class TodoSolution extends AbstractSolution
{
    public function display(OutputInterface $output): void
    {
        // noop
    }

    public function value(): mixed
    {
        return null;
    }
}
