package main

import (
	"fmt"
	"io"
	"regexp"

	"github.com/wesleyklop/advent-of-code/common"
)

func parse(reader io.Reader) string {
	return string(common.Must(io.ReadAll(reader)))
}

func part1(in string) int {
	mulregexp := regexp.MustCompile(`mul\((\d+),(\d+)\)`)
	sum := 0
	for _, match := range mulregexp.FindAllStringSubmatch(in, -1) {
		a, b := common.MustParseInt(match[1]), common.MustParseInt(match[2])
		sum += a * b
	}
	return sum
}
func part2(in string) int {
	mulEnabled := true
	sum := 0
	validInstructionRegex := regexp.MustCompile(`(mul|do|don't)\((?:(\d+),(\d+))?\)`)
	for _, match := range validInstructionRegex.FindAllStringSubmatch(in, -1) {
		if match[1] == "mul" {
			if mulEnabled {
				a, b := common.MustParseInt(match[2]), common.MustParseInt(match[3])
				sum += a * b
			}
			continue
		}
		mulEnabled = match[1] == "do"
	}
	return sum
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
