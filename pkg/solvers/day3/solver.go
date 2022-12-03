package day3

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/util"
)

type Solver struct {
	Input *util.Input
}

func (s *Solver) Parse() []rucksack {
	return util.Map(s.Input.Lines(), newRucksack)
}

func (s *Solver) SolvePartOne(ctx context.Context) (*int, error) {
	rucksacks := s.Parse()
	prioritySumOfCommonItems := util.Reduce(rucksacks, func(sum int, r rucksack) int {
		return sum + r.GetCommonItem()
	}, 0)
	return &prioritySumOfCommonItems, nil
}

func (s *Solver) SolvePartTwo(ctx context.Context) (*int, error) {
	rucksacks := util.Chunk(s.Parse(), 3)
	prioritySumOfBadges := util.Reduce(rucksacks, func(sum int, rs []rucksack) int {
		return sum + GetBadge(rs)
	}, 0)
	return &prioritySumOfBadges, nil
}
