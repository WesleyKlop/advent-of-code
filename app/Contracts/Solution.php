<?php


namespace App\Contracts;


use Symfony\Component\Console\Output\OutputInterface;

interface Solution
{
    public function display(OutputInterface $output): void;
}
