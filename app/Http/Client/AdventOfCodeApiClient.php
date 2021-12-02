<?php

declare(strict_types=1);

namespace App\Http\Client;

use App\Exceptions\ApplicationException;
use App\Exceptions\MissingSessionTokenException;
use Illuminate\Support\Facades\Http;

class AdventOfCodeApiClient
{
    final public const API_DOMAIN = 'adventofcode.com';

    final public const API_ENDPOINT = 'https://%s/%s/day/%s/input';

    public function fetchInput(int $year, int $day, bool $force = false): void
    {
        if ($force === true || ! file_exists($this->getPath($year, $day))) {
            $this->handleFileMissing($year, $day);
        }
    }

    protected function getPath(int $year, int $day): string
    {
        return resource_path(sprintf('inputs/%d/%d/%s', $year, $day, 'input.txt'));
    }

    private function handleFileMissing(int $year, int $day): void
    {
        $path = $this->getPath($year, $day);
        $session = config('app.session_token');

        if (! $session) {
            throw new MissingSessionTokenException();
        }

        // Make sure the directory to place the file in exists
        $dir = dirname($path);
        if (! is_dir($dir) && ! mkdir($dir) && ! is_dir($dir)) {
            throw new ApplicationException(sprintf('Directory "%s" was not created', $dir));
        }

        $response = Http
            ::withCookies([
                'session' => $session,
            ], self::API_DOMAIN)
                ->withOptions([
                    'sink' => $path,
                ])
                ->get(sprintf(self::API_ENDPOINT, self::API_DOMAIN, $year, $day));

        if ($response->failed()) {
            unlink($path);
        }
    }
}
