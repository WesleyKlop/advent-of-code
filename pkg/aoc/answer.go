package aoc

import (
	"context"

	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

type Answer struct {
	answer problem.Answer
}

func (a Answer) String() string {
	return a.answer.String()
}

func (a Answer) Display(ctx context.Context) {
	logger := logging.FromContext(ctx)
	logger.Info("Solution to problem", "answer", a.String())
}
