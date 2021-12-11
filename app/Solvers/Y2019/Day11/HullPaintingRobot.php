<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day11;

use App\Common\IntCode\IO\InputProvider;
use App\Common\IntCode\IO\OutputProvider;
use App\Contracts\Solution;
use App\Solutions\GridSolution;

class HullPaintingRobot implements InputProvider, OutputProvider
{
    private Direction $direction = Direction::UP;

    private Instruction $expectedInstruction = Instruction::PAINT;

    private int $x = 0;

    private int $y = 0;

    /**
     * @var PanelColor[][]
     */
    private array $panels = [];

    private int $panelsPainted = 0;

    public function __construct(PanelColor $startColor = PanelColor::BLACK)
    {
        $this->panels[$this->y][$this->x] = $startColor;
    }

    public function read(): int
    {
        return ($this->panels[$this->y][$this->x] ?? PanelColor::BLACK)->value;
    }

    public function write(int $value): void
    {
        switch ($this->expectedInstruction) {
            case Instruction::PAINT:
                $this->paint($value);
                $this->expectedInstruction = Instruction::ROTATE;
                break;
            case Instruction::ROTATE:
                $delta = $value === 1 ? 90 : -90;
                $this->rotate($delta);
                $this->forward();
                $this->expectedInstruction = Instruction::PAINT;
                break;
        }
    }

    public function getPanelsPainted(): int
    {
        return $this->panelsPainted;
    }

    public function getSolution(): Solution
    {
        return new GridSolution(0, $this->panels);
    }

    private function paint(int $value): void
    {
        $color = PanelColor::from($value);
        if (! ($this->panels[$this->y][$this->x] ?? null) instanceof PanelColor) {
            $this->panelsPainted++;
        }
        $this->panels[$this->y][$this->x] = $color;
    }

    private function rotate(int $delta): void
    {
        // Guard against under/overflow
        $newDirection = (360 + $delta + $this->direction->value) % 360;
        $this->direction = Direction::from($newDirection);
    }

    private function forward(): void
    {
        switch ($this->direction) {
            case Direction::UP:
                $this->y--;
                break;
            case Direction::DOWN:
                $this->y++;
                break;
            case Direction::LEFT:
                $this->x--;
                break;
            case Direction::RIGHT:
                $this->x++;
                break;
        }
    }
}
