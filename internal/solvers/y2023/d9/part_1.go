package d9

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part1(ctx context.Context, inp input.Input) (problem.Answer, error) {
	logger := logging.FromContext(ctx)
	lines := parse(inp.MustReadLines())
	sum := 0

	for _, line := range lines {
		sum += calcNextInSequence(logger, line)
	}

	return problem.IntAnswer(sum), nil
}
