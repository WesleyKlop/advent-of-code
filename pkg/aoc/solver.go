package aoc

import (
	"context"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

type Solver interface {
	SolvePart1(context.Context) (problem.Answer, error)
	SolvePart2(context.Context) (problem.Answer, error)
}

type solver struct {
	input input.Input
	part1 problem.Solution
	part2 problem.Solution
}

func (s solver) SolvePart1(ctx context.Context) (problem.Answer, error) {
	a, err := s.part1(ctx, s.input)
	if err != nil {
		return problem.NoAnswer, err
	}
	return Answer{a}, nil
}

func (s solver) SolvePart2(ctx context.Context) (problem.Answer, error) {
	a, err := s.part2(ctx, s.input)
	if err != nil {
		return problem.NoAnswer, err
	}
	return Answer{a}, nil
}

func NewSolver(part1 problem.Solution, part2 problem.Solution, inp input.Input) Solver {
	return solver{
		input: inp,
		part1: part1,
		part2: part2,
	}
}
