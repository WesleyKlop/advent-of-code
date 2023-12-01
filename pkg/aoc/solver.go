package aoc

import (
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

type Solver interface {
	SolvePart1() (problem.Answer, error)
	SolvePart2() (problem.Answer, error)
}

type solver struct {
	input input.Input
	part1 problem.Solution
	part2 problem.Solution
}

func (s solver) SolvePart1() (problem.Answer, error) {
	return s.part1(s.input)
}

func (s solver) SolvePart2() (problem.Answer, error) {
	return s.part2(s.input)
}

func NewSolver(part1 problem.Solution, part2 problem.Solution, inp input.Input) Solver {
	return solver{
		input: inp,
		part1: part1,
		part2: part2,
	}
}
