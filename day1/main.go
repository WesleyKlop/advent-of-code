package main

import (
	"fmt"
	"log/slog"

	"github.com/wesleyklop/advent-of-code/common"
)

func main() {
	start := common.NewStopwatch()
	fileToOpen := common.OpenPuzzleInput()

	fmt.Printf("Parsing took: %s\n", start.Click())
	common.ResetLogger(slog.LevelError)
	fmt.Printf("\n--- Part 1 ---\n")
	fmt.Printf("Answer: %d\n", part1(fileToOpen))
	fmt.Printf("Part 1 took: %s\n", start.Click())

	fileToOpen.Seek(0, 0)
	common.ResetLogger(slog.LevelDebug)
	fmt.Printf("\n--- Part 2 ---\n")
	fmt.Printf("Answer: %d\n", part2(fileToOpen))
	fmt.Printf("Part 2 took: %s\n", start.Click())
}
