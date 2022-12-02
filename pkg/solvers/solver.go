package solvers

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/solvers/day1"
	"github.com/wesleyklop/advent-of-code/pkg/solvers/day2"
)

type Solver interface {
	SolvePartOne(ctx context.Context, input *string) (int, error)
	SolvePartTwo(ctx context.Context, input *string) (int, error)
}

func GetSolver(day int) Solver {
	if day == 1 {
		return &day1.Solver{}
	}

	if day == 2 {
		return &day2.Solver{}
	}
	panic("Invalid day")
}
