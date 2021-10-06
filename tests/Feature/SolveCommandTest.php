<?php

declare(strict_types=1);

test('solve command', function () {
    $cmd = $this->artisan('solve', [
        '--year' => 2020,
        '--part' => 1,
        'day' => 1,
    ]);

    $cmd
        ->assertExitCode(0)
        ->expectsOutput('[P1] ')
        ->expectsOutput('Solution: ')
        ->expectsOutput('1020099');
});
