<?php

declare(strict_types=1);

test('solve command', function () {
    $cmd = $this->artisan('solve', [
        '--year' => 2020,
        '--part' => 1,
        'day' => 1,
    ]);

    $cmd->assertExitCode(0);
//        $cmd->expectsOutput('<info>[P1]</info>');
//    $cmd->expectsOutput('[P1] Solution: 1020099');
//    $cmd->expectsOutput('[P1] Solution: 1020099');
});
