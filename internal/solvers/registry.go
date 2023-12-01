package solvers

import (
	"github.com/wesleyklop/advent-of-code/internal/solvers/y2023"
	"github.com/wesleyklop/advent-of-code/pkg/aoc"
)

func GetSolver(year aoc.Year, day aoc.Day, typ aoc.FileType) (aoc.Solver, error) {
	inp, err := aoc.NewInput(year, day, typ)
	if err != nil {
		return nil, err
	}
	switch year {
	case aoc.Y2023:
		return y2023.GetSolver(day, inp), nil
	}
	panic("Invalid year!")
}
