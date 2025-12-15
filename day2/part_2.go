package main

import (
	"io"
	"log/slog"
)

func part2(in io.Reader) int {
	ranges := parseInput(in)
	sumOfInvalidIDs := 0
	for _, r := range ranges {
		slog.Debug("Working on range", "r", r)
		for invalidID := range r.IDsInRangeRepeatedAny() {
			slog.Debug("got invalid id", "id", invalidID)
			sumOfInvalidIDs += invalidID
		}
	}
	return sumOfInvalidIDs
}
