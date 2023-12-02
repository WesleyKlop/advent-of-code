package problem

import (
	"context"

	"github.com/wesleyklop/advent-of-code/pkg/input"
)

type Solution func(ctx context.Context, input input.Input) (Answer, error)
