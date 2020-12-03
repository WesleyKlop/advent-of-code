<?php


namespace App\Http\Client;

use App\Exceptions\ApplicationException;
use App\Exceptions\MissingSessionTokenException;
use Illuminate\Support\Facades\Http;

class AdventOfCodeApiClient
{
    public const API_DOMAIN = 'adventofcode.com';
    public const API_ENDPOINT = 'https://%s/%s/day/%s/input';

    public function fetchInput(string $year, string $day, bool $force = false): void
    {
        if (!file_exists($this->getPath($year, $day)) || $force === true) {
            $this->handleFileMissing($year, $day);
        }
    }

    protected function getPath(string $year, string $day): string
    {
        return resource_path(sprintf("inputs/%s/%s/%s", $year, $day, 'input.txt'));
    }

    private function handleFileMissing(string $year, string $day): void
    {
        $path = $this->getPath($year, $day);
        $session = env('AOC_SESSION_TOKEN');

        if (!$session) {
            throw new MissingSessionTokenException();
        }

        // Make sure the directory to place the file in exists
        if (!is_dir($dir = dirname($path)) && !mkdir($dir) && !is_dir($dir)) {
            throw new ApplicationException(sprintf('Directory "%s" was not created', $dir));
        }

        $response = Http
            ::withCookies(['session' => $session], self::API_DOMAIN)
            ->withOptions(['sink' => $path])
            ->get(sprintf(self::API_ENDPOINT, self::API_DOMAIN, $year, $day));

        if ($response->failed()) {
            unlink($path);
        }
    }
}
