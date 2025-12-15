package main

import (
	"bufio"
	"io"
	"log/slog"

	"github.com/wesleyklop/advent-of-code/common"
)

const DialSize = 100

func part2(in io.Reader) int {
	current := 50
	zeros := 0
	scanner := bufio.NewScanner(in)

	slog.Info("The dial starts by pointing at", "pos", current)
	for scanner.Scan() {
		line := scanner.Text()
		dir, amount := line[0], common.MustParseInt(line[1:])
		// logger := slog.Default().With("instruction", line)

		if dir == 'L' {
			amount = -amount
		}
		zeros += countZeroHits(current, amount, DialSize)
		current = (current + amount) % DialSize
		if current < 0 {
			current += 100
		}

		// logger.Info("The dial is rotated", "end", , "zeros", crossings)
	}
	return zeros
}

func countZeroHits(start, amount, dialSize int) int {
	if amount == 0 {
		return 0
	}

	dir := 1
	if amount < 0 {
		dir = -1
		amount = -amount
	}

	target := (-start * dir) % dialSize
	if target < 0 {
		target += dialSize
	}

	if target == 0 {
		target = dialSize
	}

	if target > amount {
		return 0
	}

	return 1 + (amount-target)/dialSize
}
