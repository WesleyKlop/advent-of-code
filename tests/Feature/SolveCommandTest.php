<?php

test('solve command', function () {
    $cmd = $this->artisan('solve', [
        '--year' => 2020,
        '--part' => 1,
        'day' => 1,
    ]);

    $cmd
        ->assertExitCode(0)
        ->expectsOutput('[Part 1] ')
        ->expectsOutput('Solution: ')
        ->expectsOutput('1020099');
});
