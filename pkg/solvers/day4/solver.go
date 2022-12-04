package day4

import (
	"context"
	"fmt"
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"strings"
)

type Solver struct {
	Input *util.Input
}

func (s *Solver) Parse() [][]sectionRange {
	return util.Map(s.Input.Lines(), func(line string) []sectionRange {
		return util.Map(strings.Split(line, ","), newSectionRange)
	})
}

func (s *Solver) SolvePartOne(ctx context.Context) (*int, error) {
	sectionRanges := s.Parse()
	pairsThatFullyContainTheOther := util.Reduce(sectionRanges, func(sum int, pair []sectionRange) int {
		if pair[0].FullyContains(pair[1]) || pair[1].FullyContains(pair[0]) {
			return sum + 1
		}
		return sum
	}, 0)
	return &pairsThatFullyContainTheOther, nil
}

func (s *Solver) SolvePartTwo(ctx context.Context) (*int, error) {
	sectionRanges := s.Parse()
	pairsThatPartiallyContainTheOther := util.Reduce(sectionRanges, func(sum int, pair []sectionRange) int {
		if pair[0].PartiallyContains(pair[1]) || pair[1].PartiallyContains(pair[0]) {
			fmt.Printf("%+v\n", pair)
			return sum + 1
		}
		return sum
	}, 0)
	return &pairsThatPartiallyContainTheOther, nil
}
