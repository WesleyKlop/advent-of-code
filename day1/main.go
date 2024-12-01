package main

import (
	"context"
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

func main() {
	_ = context.Background()
	fileToOpen := os.Args[1]

	contents := strings.TrimSpace(string(must(io.ReadAll(must(os.Open(fileToOpen))))))

	fmt.Printf("contents: %s\n", contents)

	listA, listB := parseLists(contents)

	fmt.Printf("%+v, %+v\n", listA, listB)

	var total float64 = 0
	for i := 0; i < len(listA); i++ {
		total += math.Abs(float64(listA[i] - listB[i]))
	}

	fmt.Printf("ans: %f\n", total)
}
