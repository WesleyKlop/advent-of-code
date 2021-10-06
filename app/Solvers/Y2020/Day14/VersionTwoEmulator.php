<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day14;

class VersionTwoEmulator extends Emulator
{
    public function writeToMemory(int $address, int $value): void
    {
        $binaryAddress = $this->convertValueToBinary($address);
        $convertedAddress = $this->applyBitmask($binaryAddress);
        foreach ($this->iterateFloatingBits($convertedAddress) as $actualAddress) {
            $this->memory[$actualAddress] = $value;
        }
    }

    private function applyBitmask(string $binaryAddress): string
    {
        foreach ($this->bitmask as $idx => $char) {
            if ($char === '0') {
                continue;
            }
            // Replace 1 and X
            $binaryAddress[$idx] = $char;
        }

        return $binaryAddress;
    }

    private function iterateFloatingBits(string $convertedAddress, int $idx = 0): iterable
    {
        if ($idx === 36) {
            // Yield the final address when at the end of the string
            yield bindec($convertedAddress);
        } elseif ($convertedAddress[$idx] === 'X') {
            // Replace address with both options, and go to the next character.
            $convertedAddress[$idx] = '0';
            yield from $this->iterateFloatingBits($convertedAddress, $idx + 1);
            $convertedAddress[$idx] = '1';
            yield from $this->iterateFloatingBits($convertedAddress, $idx + 1);
        } else {
            // Just go to the next character
            yield from $this->iterateFloatingBits($convertedAddress, $idx + 1);
        }
    }
}
