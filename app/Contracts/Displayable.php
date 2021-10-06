<?php

declare(strict_types=1);

namespace App\Contracts;

use Symfony\Component\Console\Output\OutputInterface;

interface Displayable
{
    public function display(OutputInterface $output): void;
}
