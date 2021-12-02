<?php

declare(strict_types=1);

namespace App\Commands;

use App\Http\Client\AdventOfCodeApiClient;
use LaravelZero\Framework\Commands\Command;

class FetchCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'fetch
        {--year=2021 : The year to fetch input for}
        {--force : Overwrite existing file}
        {day : The day to fetch input for}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Fetch the puzzle for a given day.';

    /**
     * Execute the console command.
     */
    public function handle(AdventOfCodeApiClient $apiClient): int
    {
        $year = (int) $this->option('year');
        $day = (int) $this->argument('day');

        $apiClient->fetchInput(
            $year,
            $day,
            $this->option('force'),
        );

        $this->info("Retrieved input file for year ${year} day ${day}");

        return 0;
    }
}
