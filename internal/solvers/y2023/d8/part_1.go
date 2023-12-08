package d8

import (
	"context"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part1(_ context.Context, inp input.Input) (problem.Answer, error) {
	instructions, nodes := parseInput(inp.MustReadSplitOn("\n\n"))

	rounds := 0
	currentNode := "AAA"
	if _, ok := nodes[currentNode]; !ok {
		return problem.NoAnswer, nil
	}
	for _ = 0; currentNode != "ZZZ"; rounds++ {
		instruction := instructions[(rounds)%len(instructions)]

		currentNode = nodes[currentNode][instruction]
	}
	return problem.IntAnswer(rounds), nil
}
