package y2023

import (
	"github.com/wesleyklop/advent-of-code/internal/solvers/y2023/d1"
	"github.com/wesleyklop/advent-of-code/internal/solvers/y2023/d2"
	"github.com/wesleyklop/advent-of-code/internal/solvers/y2023/d3"
	"github.com/wesleyklop/advent-of-code/internal/solvers/y2023/d4"
	"github.com/wesleyklop/advent-of-code/internal/solvers/y2023/d5"
	"github.com/wesleyklop/advent-of-code/pkg/aoc"
	"github.com/wesleyklop/advent-of-code/pkg/input"
)

func GetSolver(day aoc.Day, inp input.Input) aoc.Solver {
	switch day {
	case 1:
		return d1.NewSolver(inp)
	case 2:
		return d2.NewSolver(inp)
	case 3:
		return d3.NewSolver(inp)
	case 4:
		return d4.NewSolver(inp)
	case 5:
		return d5.NewSolver(inp)
	}
	panic("Invalid day!")
}
