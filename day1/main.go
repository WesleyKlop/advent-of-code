package main

import (
	"bufio"
	"fmt"
	"io"
	"log/slog"

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
		slog.Info("Value after", "dir", string(dir), "amt", amount, "status", status)
	}
	return zeros
}

func part2(in io.Reader) int {
	return 0
}

func main() {
	start := common.NewStopwatch()
	fileToOpen := common.OpenPuzzleInput()

	fmt.Printf("Parsing took: %s\n", start.Click())

	fmt.Printf("\n--- Part 1 ---\n")
	fmt.Printf("Answer: %d\n", part1(fileToOpen))
	fmt.Printf("Part 1 took: %s\n", start.Click())

	fmt.Printf("\n--- Part 2 ---\n")
	fmt.Printf("Answer: %d\n", part2(fileToOpen))
	fmt.Printf("Part 2 took: %s\n", start.Click())
}
