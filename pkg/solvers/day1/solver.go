package day1

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"strings"
)

type Solver struct{}

func (s *Solver) Parse(input *string) *[]*[]int {
	trimmed := strings.Trim(*input, "\n")
	elves := strings.Split(trimmed, "\n\n")
	caloriesPerElf := make([]*[]int, len(elves))
	for i, elf := range elves {
		elfList := strings.Split(elf, "\n")
		elfCalories := util.MapStringsToInt(&elfList)
		caloriesPerElf[i] = elfCalories
	}
	return &caloriesPerElf
}

func (s *Solver) SolvePartOne(ctx context.Context, input *string) (int, error) {
	caloriesPerElf := s.Parse(input)
	max := 0
	for _, elf := range *caloriesPerElf {
		sum := 0
		for _, cals := range *elf {
			sum += cals
		}
		if sum > max {
			max = sum
		}
	}
	return max, nil
}

func (s *Solver) SolvePartTwo(ctx context.Context, input *string) (int, error) {
	caloriesPerElf := s.Parse(input)
	topThree := make([]int, 3)
	for _, elf := range *caloriesPerElf {
		sum := 0
		for _, cals := range *elf {
			sum += cals
		}

		// For every entry,
		minIdx := -1
		for i, val := range topThree {
			if minIdx == -1 || val < topThree[minIdx] {
				minIdx = i
			}
		}
		if sum > topThree[minIdx] {
			topThree[minIdx] = sum
		}
	}
	sum := 0
	for _, val := range topThree {
		sum += val
	}
	return sum, nil
}
