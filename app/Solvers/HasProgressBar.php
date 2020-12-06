<?php


namespace App\Solvers;


use Symfony\Component\Console\Helper\ProgressBar;

trait HasProgressBar
{
    protected ProgressBar $progressBar;

    public function setProgressBar(ProgressBar $progressBar) {
        $this->progressBar = $progressBar;
    }

}
