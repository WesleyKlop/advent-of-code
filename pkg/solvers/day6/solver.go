package day6

import (
	"context"
	"fmt"
	"github.com/wesleyklop/advent-of-code/pkg/util"
)

type Solver struct {
	Input *util.Input
}

func (s *Solver) Parse() []string {
	return s.Input.SplitOn("")
}

func (s *Solver) SolvePartOne(ctx context.Context) (*int, error) {
	sequence := s.Parse()

	for i := 3; i < len(sequence); i++ {
		seen := util.NewSet[string]()
		for idx := i - 3; idx <= i; idx++ {
			seen.Add(sequence[idx])
		}
		if seen.Len() == 4 {
			answer := i + 1
			return &answer, nil
		}
	}

	fmt.Printf("Did not find sequence :(\n")
	return nil, nil
}

func (s *Solver) SolvePartTwo(ctx context.Context) (*int, error) {
	sequence := s.Parse()

	for i := 13; i < len(sequence); i++ {
		seen := util.NewSet[string]()
		for idx := i - 13; idx <= i; idx++ {
			seen.Add(sequence[idx])
		}
		if seen.Len() == 14 {
			answer := i + 1
			return &answer, nil
		}
	}

	fmt.Printf("Did not find sequence :(\n")
	return nil, nil
}
