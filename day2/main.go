package main

import (
	"fmt"

	"github.com/wesleyklop/advent-of-code/common"
)

func main() {
	start := common.NewStopwatch()
	fileToOpen := common.OpenPuzzleInput()

	common.ConfigureLogger()
	fmt.Printf("\n--- Part 1 ---\n")
	fmt.Printf("Answer: %d\n", part1(fileToOpen))
	fmt.Printf("Part 1 took: %s\n", start.Click())

	fileToOpen.Seek(0, 0)
	start.Click()
	fmt.Printf("\n--- Part 2 ---\n")
	fmt.Printf("Answer: %d\n", part2(fileToOpen))
	fmt.Printf("Part 2 took: %s\n", start.Click())
}
