package main

import (
	"bufio"
	"io"

	"github.com/wesleyklop/advent-of-code/common"
)

func part1(in io.Reader) int {
	status := 50
	zeros := 0
	scanner := bufio.NewScanner(in)

	for scanner.Scan() {
		line := scanner.Text()
		dir, rawAmount := line[0], line[1:]
		if dir != 'L' && dir != 'R' {
			panic("wat is deez lijn? " + string(dir))
		}
		amount := common.MustParseInt(rawAmount)
		if dir == 'L' {
			amount *= -1
		}
		status = (status + 100 + amount) % 100

		if status == 0 {
			zeros++
		}
	}
	return zeros
}
