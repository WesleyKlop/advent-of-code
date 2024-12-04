package main

import (
	"fmt"
	"io"
	"strings"

	"github.com/wesleyklop/advent-of-code/common"
)

func parse(reader io.Reader) []string {
	return strings.Split(strings.TrimSpace(string(common.Must(io.ReadAll(reader)))), "\n")
}

func countXMASTowards(in []string, sub string, y, x, dy, dx int) (count int) {
	if sub == "" {
		return 1
	}
	x, y = x+dx, y+dy

	if x < 0 || y < 0 || y >= len(in) || x >= len(in[y]) {
		return
	}
	head, tail := sub[0], sub[1:]
	if in[y][x] != head {
		return 0
	}

	return countXMASTowards(in, tail, y, x, dy, dx)
}

func countXMASAroundLetter(in []string, y, x int) (count int) {
	deltas := [][]int{
		{-1, -1}, {-1, 0}, {-1, 1},
		{0, -1} /*{0,0},*/, {0, 1},
		{1, -1}, {1, 0}, {1, 1},
	}
	for _, delta := range deltas {
		count += countXMASTowards(in, "MAS", y, x, delta[0], delta[1])
	}

	return
}

func part1(in []string) (count int) {
	for y := 0; y < len(in); y++ {
		for x := 0; x < len(in[y]); x++ {
			if in[y][x] == 'A' {
				count += countXMASCross(in, y, x)
			}
		}
	}
	return
}

func countXMASCross(in []string, y, x int) (count int) {
	defer func() {
		if p := recover(); p != nil {
			fmt.Printf("yeet out of bounds: %s\n", p)
		}
	}()
	// M A S: tl -> br or S A M: tl -> br
	if (in[y-1][x-1] != 'M' || in[y+1][x+1] != 'S') && (in[y-1][x-1] != 'S' || in[y+1][x+1] != 'M') {
		return
	}
	// M A S: tr -> bl or S A M: tr -> bl
	if (in[y-1][x+1] != 'M' || in[y+1][x-1] != 'S') && (in[y-1][x+1] != 'S' || in[y+1][x-1] != 'M') {
		return
	}
	return 1
}

func part2(in []string) (count int) {
	for y := 0; y < len(in); y++ {
		for x := 0; x < len(in[y]); x++ {
			if in[y][x] == 'X' {
				count += countXMASAroundLetter(in, y, x)
			}
		}
	}
	return
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
