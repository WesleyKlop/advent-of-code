package solvers

import "context"

type Solver interface {
	SolvePartOne(ctx context.Context, input *string) (int, error)
	SolvePartTwo(ctx context.Context, input *string) (int, error)
}
