package day5

import (
	"context"
	"fmt"
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"strings"
)

type Solver struct {
	Input *util.Input
}

func (s *Solver) Parse() ([]util.Stack[string], []move) {
	splitted := s.Input.SplitOn("\n\n")
	stacks := parseStacks(strings.Split(splitted[0], "\n"))
	moves := parseMoves(strings.Split(splitted[1], "\n"))

	return stacks, moves
}

func (s *Solver) SolvePartOne(ctx context.Context) (*int, error) {
	crateStacks, moves := s.Parse()

	for _, turn := range moves {
		for i := 0; i < turn.Amount; i++ {
			crateStacks[turn.To].Push(crateStacks[turn.From].Pop())
		}
	}

	answer := ""
	for i := range crateStacks {
		answer += crateStacks[i].Pop()
	}
	fmt.Printf("%s\n", answer)

	return nil, nil
}

func (s *Solver) SolvePartTwo(ctx context.Context) (*int, error) {
	crateStacks, moves := s.Parse()

	for _, turn := range moves {
		crates := crateStacks[turn.From].PopN(turn.Amount)
		for i := 0; i < len(crates); i++ {
			crateStacks[turn.To].Push(crates[i])
		}
	}

	answer := ""
	for i := range crateStacks {
		answer += crateStacks[i].Pop()
	}
	fmt.Printf("%s\n", answer)

	return nil, nil
}
