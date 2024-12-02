package main

import (
	"fmt"
	"io"

	"github.com/wesleyklop/advent-of-code/common"
)

func parse(reader io.Reader) string {
	// parse file into wanted format
	return string(common.Must(io.ReadAll(reader)))
}

func part1(in string) {
	// calculate part 1
}
func part2(in string) {
	// calculate part 2
}

func main() {
	start := common.NewStopwatch()
	fileToOpen := common.OpenPuzzleInput()

	parsed := parse(fileToOpen)
	fmt.Printf("Finished parsing: %s\n", start.Click())

	fmt.Printf("\n--- Part 1 ---\n")
	part1(parsed)
	fmt.Printf("Finished part 1: %s\n", start.Click())

	fmt.Printf("\n--- Part 2 ---\n")
	part2(parsed)
	fmt.Printf("Finished part 2: %s\n", start.Click())
}
