package d8

import (
	"github.com/wesleyklop/advent-of-code/pkg/aoc"
	"github.com/wesleyklop/advent-of-code/pkg/input"
)

func NewSolver(inp input.Input) aoc.Solver {
	return aoc.NewSolver(part1, part2, inp)
}
