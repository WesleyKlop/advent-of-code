<?php


namespace App\Contracts;


use Symfony\Component\Console\Helper\ProgressBar;

interface HasProgressBar
{
    public function setProgressBar(ProgressBar $progressBar): void;
}
