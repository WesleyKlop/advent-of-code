package main

import (
	"errors"
	"fmt"
	"io"
	"math"
	"os"
	"slices"

	"github.com/wesleyklop/pragmatic-advent-of-code/common"
)

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

func readLists(f io.Reader) ([]int, []int) {
	listA, listB := make([]int, 1024), make([]int, 1024)

	idx := 0
	for {
		_, err := fmt.Fscanf(f, "%d   %d\n", &listA[idx], &listB[idx])
		if errors.Is(err, io.EOF) {
			break
		}
		idx++
	}

	// Shrink slices to their actual size
	listA, listB = listA[:idx], listB[:idx]

	slices.Sort(listA)
	slices.Sort(listB)

	return listA, listB
}

func main() {
	start := common.NewStopwatch()
	fileToOpen := os.Args[1]

	listA, listB := readLists(common.Must(os.Open(fileToOpen)))
	fmt.Printf("Finished parsing: %s\n", start.Click())

	fmt.Printf("\n--- Part 1 ---\n")
	part1(listA, listB)
	fmt.Printf("Finished part 1: %s\n", start.Click())

	fmt.Printf("\n--- Part 2 ---\n")
	part2(listA, listB)
	fmt.Printf("Finished part 2: %s\n", start.Click())
}
