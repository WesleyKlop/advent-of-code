package y2023

import (
	"github.com/wesleyklop/advent-of-code/internal/solvers/y2023/d1"
	"github.com/wesleyklop/advent-of-code/pkg/aoc"
	"github.com/wesleyklop/advent-of-code/pkg/input"
)

func GetSolver(day aoc.Day, inp input.Input) aoc.Solver {
	switch day {
	case 1:
		return d1.NewSolver(inp)
	}
	panic("Invalid day!")
}
