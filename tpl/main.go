package main

import (
	"fmt"
	"io"

	"github.com/wesleyklop/advent-of-code/common"
)

func parse(reader io.Reader) string {
	return string(common.Must(io.ReadAll(reader)))
}

func part1(in string) int {
	return len(in)
}

func part2(in string) int {
	return len(in)
}

func main() {
	start := common.NewStopwatch()
	fileToOpen := common.OpenPuzzleInput()

	parsed := parse(fileToOpen)
	fmt.Printf("Parsing took: %s\n", start.Click())

	fmt.Printf("\n--- Part 1 ---\n")
	fmt.Printf("Answer: %d\n", part1(parsed))
	fmt.Printf("Part 1 took: %s\n", start.Click())

	fmt.Printf("\n--- Part 2 ---\n")
	fmt.Printf("Answer: %d\n", part2(parsed))
	fmt.Printf("Part 2 took: %s\n", start.Click())
}
