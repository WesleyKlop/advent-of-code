package solvers

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/solvers/day1"
	"github.com/wesleyklop/advent-of-code/pkg/solvers/day2"
	"github.com/wesleyklop/advent-of-code/pkg/util"
)

type Solver interface {
	SolvePartOne(ctx context.Context) (int, error)
	SolvePartTwo(ctx context.Context) (int, error)
}

func GetSolver(day int, input *util.Input) Solver {
	switch day {
	case 1:
		return &day1.Solver{Input: input}
	case 2:
		return &day2.Solver{Input: input}
	}
	panic("Invalid day")
}
