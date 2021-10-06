<?php

declare(strict_types=1);

namespace App\Contracts;

use Symfony\Component\Console\Helper\ProgressBar;

interface HasProgressBar
{
    public function setProgressBar(ProgressBar $progressBar): void;
}
