<?php


namespace App\Contracts;

use Symfony\Component\Console\Output\OutputInterface;

interface Displayable
{
    public function display(OutputInterface $output): void;
}
