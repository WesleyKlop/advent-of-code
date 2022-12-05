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
	for i := range crateStacks {
		fmt.Printf("%+v\n", crateStacks[i].Peek())
	}

	for _, turn := range moves {
		for i := 0; i < turn.Amount; i++ {
			moving := crateStacks[turn.From].Pop()
			fmt.Printf("move %d from %d to %d (%s)\n", turn.Amount, turn.From+1, turn.To+1, moving)
			crateStacks[turn.To].Push(moving)
		}
	}

	answer := ""
	for i := range crateStacks {
		fmt.Printf("%+v\n", crateStacks[i].Peek())
		answer += crateStacks[i].Pop()
	}
	fmt.Printf("%+v\n", answer)

	oof := -1
	return &oof, util.Todo{}
}

func (s *Solver) SolvePartTwo(ctx context.Context) (*int, error) {
	return nil, util.Todo{}
}
