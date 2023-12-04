package d4

import (
	"context"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part1(ctx context.Context, inp input.Input) (problem.Answer, error) {
	logger := logging.FromContext(ctx)
	sum := 0
	for _, line := range inp.MustReadLines() {
		meta, data, _ := strings.Cut(line, ": ")
		rawWinningNr, rawMyNr, _ := strings.Cut(strings.TrimSpace(data), " | ")
		winningNr := collections.NewSetFromSlice(
			collections.MapStringsToInt(strings.Fields(rawWinningNr)),
		)
		myNr := collections.NewSetFromSlice(
			collections.MapStringsToInt(strings.Fields(rawMyNr)),
		)

		points := 0
		for _, myNr := range myNr.Values() {
			if !winningNr.Has(myNr) {
				continue
			}
			if points == 0 {
				points = 1
			} else {
				points *= 2
			}
			//logger.Debug(meta, "winning nr", myNr, "newPoints", points)
		}
		if points > 0 {
			logger.Info(meta+" is worth", "points", points)
		}
		sum += points
	}

	return problem.IntAnswer(sum), nil
}
