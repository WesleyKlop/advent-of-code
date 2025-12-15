package main

import (
	"io"
)

func part1(in io.Reader) int {
	ranges := parseInput(in)
	sumOfInvalidIDs := 0
	for _, r := range ranges {
		for invalidID := range r.IDsInRangeRepeatedTwice() {
			sumOfInvalidIDs += invalidID
		}
	}
	return sumOfInvalidIDs
}
