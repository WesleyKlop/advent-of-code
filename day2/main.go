package main

import (
	"bufio"
	"fmt"
	"io"
	"math"
	"slices"
	"strconv"
	"strings"

	"github.com/wesleyklop/advent-of-code/common"
)

func parse(reader io.Reader) [][]int {
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

func isValidReport(report []int, idx int, sign *bool) bool {
	// End condition, idx+1 is nil
	if len(report) == idx+1 {
		return true
	}

	a, b := report[idx], report[idx+1]

	// Compare first two levels for increase/decrease
	if sign == nil {
		s := a-b > 0
		return isValidReport(report, idx, &s)
	}

	// Rule 1: every step must be increasing/decreasing depending on sign
	if *sign && a < b {
		return false
	}
	if !*sign && b < a {
		return false
	}

	// Rule 2: levels must differ between at least 1 and at most 3
	if diff := int(math.Abs(float64(a - b))); diff < 1 || diff > 3 {
		return false
	}

	return isValidReport(report, idx+1, sign)
}

func part1(reports [][]int) int {
	validReports := 0
	for _, line := range reports {
		if isValidReport(line, 0, nil) {
			validReports++
		}
	}
	return validReports
}

func part2(reports [][]int) int {
	validReports := 0
	for _, line := range reports {
		if isValidReport(line, 0, nil) {
			validReports++
			continue
		}

		for i := 0; i < len(line); i++ {
			report := common.RemoveFromSlice(slices.Clone(line), i)
			if isValidReport(report, 0, nil) {
				validReports++
				break
			}
		}
	}
	return validReports
}

func main() {
	stopWatch := common.NewStopwatch()
	fileToOpen := common.OpenPuzzleInput()

	parsed := parse(fileToOpen)
	fmt.Printf("Parsing took: %s\n", stopWatch.Click())

	fmt.Printf("\n--- Part 1 ---\n")
	validReports := part1(parsed)
	fmt.Printf("Answer: %d\n", validReports)
	fmt.Printf("Part 1 took: %s\n", stopWatch.Click())

	fmt.Printf("\n--- Part 2 ---\n")
	validReports = part2(parsed)
	fmt.Printf("Answer: %d\n", validReports)
	fmt.Printf("Part 2 took: %s\n", stopWatch.Click())
}
