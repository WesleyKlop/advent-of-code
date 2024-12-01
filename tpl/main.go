package main

import (
	"fmt"
	"io"
	"os"

	"github.com/wesleyklop/pragmatic-advent-of-code/common"
)

func OpenPuzzleInput() *os.File {
	if f := os.Args[1]; f != "" {
		return common.Must(os.OpenFile(f, os.O_RDONLY, 0444))
	}
	panic("missing argument file")
}

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
	fileToOpen := OpenPuzzleInput()

	parsed := parse(fileToOpen)
	fmt.Printf("Finished parsing: %s\n", start.Click())

	fmt.Printf("\n--- Part 1 ---\n")
	part1(parsed)
	fmt.Printf("Finished part 1: %s\n", start.Click())

	fmt.Printf("\n--- Part 2 ---\n")
	part2(parsed)
	fmt.Printf("Finished part 2: %s\n", start.Click())
}
