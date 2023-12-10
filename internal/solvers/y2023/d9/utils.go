package d9

import (
	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"log/slog"
)

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
