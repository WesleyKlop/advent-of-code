package main

import (
	"fmt"
	"io"
	"math"
	"os"
	"slices"
	"strings"
)

func must[T any](v T, err error) T {
	if err != nil {
		panic(fmt.Errorf("must: %w", err))
	}
	return v
}

func parseLists(in string) ([]int, []int) {
	rows := strings.Split(in, "\n")

	listA := make([]int, len(rows))
	listB := make([]int, len(rows))

	for idx, row := range rows {
		_, _ = fmt.Sscanf(row, "%d   %d", &listA[idx], &listB[idx])
	}

	slices.Sort(listA)
	slices.Sort(listB)

	return listA, listB
}

func part1(listA, listB []int) {
	var total float64 = 0
	for i := 0; i < len(listA); i++ {
		total += math.Abs(float64(listA[i] - listB[i]))
	}

	fmt.Printf("ans: %d\n", int(total))
}

func part2(listA, listB []int) {
	similarityScore := 0
	for _, a := range listA {
		occurences := 0
		for _, b := range listB {
			if a == b {
				occurences++
			}
		}
		similarityScore += a * occurences
	}

	fmt.Printf("ans: %d\n", similarityScore)
}

func main() {
	fileToOpen := os.Args[1]

	contents := strings.TrimSpace(string(must(io.ReadAll(must(os.Open(fileToOpen))))))
	listA, listB := parseLists(contents)

	part1(listA, listB)

	fmt.Printf("--- Part 2 ---\n")

	part2(listA, listB)
}
