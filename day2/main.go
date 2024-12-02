package main

import (
	"bufio"
	"fmt"
	"io"
	"math"
	"os"
	"slices"
	"strconv"
	"strings"

	"github.com/wesleyklop/pragmatic-advent-of-code/common"
)

func OpenPuzzleInput() *os.File {
	if f := os.Args[1]; f != "" {
		return common.Must(os.OpenFile(f, os.O_RDONLY, 0444))
	}
	panic("missing argument file")
}

func parse(reader io.Reader) [][]int {
	// parse file into wanted format
	scanner := bufio.NewScanner(reader)
	out := make([][]int, 0, 1024)
	for scanner.Scan() {
		raw := strings.Fields(scanner.Text())
		tmp := make([]int, 0, 64)
		for _, r := range raw {
			tmp = append(tmp, common.Must(strconv.Atoi(r)))
		}
		out = append(out, tmp)
	}
	return out
}

func remove(slice []int, s int) []int {
	clone := slices.Clone(slice)
	return append(clone[:s], clone[s+1:]...)
}

func isValidReport(report []int, idx int, sign *bool) bool {
	// Compare first two levels for increase/decrease
	if sign == nil {
		s := report[idx]-report[idx+1] > 0
		return isValidReport(report, idx, &s)
	}

	// End condition, idx+1 is nil
	if len(report) == idx+1 {
		fmt.Printf("report %v is valid\n", report)
		return true
	}

	a, b := report[idx], report[idx+1]

	// Rule 1: every step must be increasing/decreasing depending on sign
	if *sign && a < b {
		fmt.Printf("report %v is not valid because %v and %d > %d\n", report, *sign, a, b)
		return false
	}
	if !*sign && b < a {
		fmt.Printf("report %v is not valid because %v and %d > %d\n", report, *sign, b, a)
		return false
	}

	// Rule 2: levels must differ between at least 1 and at most 3
	if diff := int(math.Abs(float64(a - b))); diff < 1 || diff > 3 {
		fmt.Printf("report %v is not valid because %d is not between 1 and 3\n", report, diff)
		return false
	}

	return isValidReport(report, idx+1, sign)
}

func part1(in [][]int) {
	validReports := 0
	for _, line := range in {
		if isValidReport(line, 0, nil) {
			validReports++
		}
	}
	fmt.Printf("ans: %d\n", validReports)
}
func part2(in [][]int) {
	validReports := 0
	for _, line := range in {
		if isValidReport(line, 0, nil) {
			validReports++
			continue
		}

		for i := 0; i < len(line); i++ {
			if isValidReport(remove(line, i), 0, nil) {
				validReports++
				break
			}
		}
	}
	fmt.Printf("ans: %d\n", validReports)
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
