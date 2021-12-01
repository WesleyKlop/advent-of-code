<?php

declare(strict_types=1);

namespace App\Commands;

use App\Exceptions\ApplicationException;
use LaravelZero\Framework\Commands\Command;

class ScaffoldCommand extends Command
{
    private const DIRECTORY_TEMPLATE = __DIR__ . '/../Solvers/Y%d/Day%d/Solver.php';

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'scaffold
        {--year=2021 : The year to fetch input for}
        {--force : Overwrite existing file}
        {day : The day to fetch input for}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a Solver class.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // First make sure the directory exists.
        $this->assertDirectoryExists();

        if ($this->shouldKeepExistingSolver()) {
            return 0;
        }

        $stub = $this->loadStub();
        $solver = str_replace(
            [':year', ':day'],
            [$this->option('year'), $this->argument('day')],
            $stub,
        );

        $this->writeSolver($solver);

        if ($this->confirm('Would you like to fetch the input file?', true)) {
            $this->call(FetchCommand::class, [
                '--year' => $this->option('year'),
                'day' => $this->argument('day'),
            ]);
        }

        return 0;
    }

    private function assertDirectoryExists(): void
    {
        $path = $this->getDestinationPath();
        // Make sure the directory to place the file in exists
        $dir = dirname($path);
        if (! is_dir($dir) && ! mkdir($dir) && ! is_dir($dir)) {
            throw new ApplicationException(sprintf('Directory "%s" was not created', $dir));
        }
    }

    private function getDestinationPath(): string
    {
        return sprintf(self::DIRECTORY_TEMPLATE, $this->option('year'), $this->argument('day'));
    }

    private function loadStub(): string
    {
        return file_get_contents(resource_path('stubs/Solver.stub'));
    }

    private function writeSolver(string $solver): void
    {
        file_put_contents($this->getDestinationPath(), $solver);
    }

    private function shouldKeepExistingSolver(): bool
    {
        return file_exists($this->getDestinationPath())
            && ! $this->option('force')
            && ! $this->confirm('The solver already exists. Overwrite?', false);
    }
}
