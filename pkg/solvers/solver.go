package solvers

import "context"

type Solver interface {
	Solve(ctx context.Context, input string) (int, error)
}
