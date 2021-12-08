<?php

declare(strict_types=1);

namespace App\Common\IntCode\IO;

trait HasIoDevice
{
    private ?InputProvider $inputProvider = null;

    private ?OutputProvider $outputProvider = null;

    public function setOutputProvider(OutputProvider $outputProvider): void
    {
        $this->outputProvider = $outputProvider;
    }

    public function setInputProvider(InputProvider $inputProvider): void
    {
        $this->inputProvider = $inputProvider;
    }

    public function attach(InputProvider|OutputProvider $device): void
    {
        if ($device instanceof InputProvider) {
            $this->setInputProvider($device);
        }
        if ($device instanceof OutputProvider) {
            $this->setOutputProvider($device);
        }
    }
}
