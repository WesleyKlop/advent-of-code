package d9

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
	"log/slog"
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

func calcNextInSequence(logger *slog.Logger, line []int) int {
	diffs := make([]int, 0, len(line)-1)
	isAll0 := true
	for i := 1; i < len(line); i++ {
		diffs = append(diffs, line[i]-line[i-1])
		isAll0 = isAll0 && diffs[i-1] == 0
	}
	if isAll0 {
		return line[len(line)-1]
	}

	return line[len(line)-1] + calcNextInSequence(logger, diffs)
}

func parse(lines []string) [][]int {
	out := make([][]int, 0, len(lines))
	for _, line := range lines {
		out = append(out, collections.IntFields(line))
	}
	return out
}
