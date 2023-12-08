package d8

import (
	"context"

	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/math"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part2(_ context.Context, inp input.Input) (problem.Answer, error) {
	instructions, nodes := parseInput(inp.MustReadSplitOn("\n\n"))
	// For each starting node we calculate how many steps to ..Z
	currentNodes := make(map[string]int, len(nodes))
	for k, _ := range nodes {
		if k[2] != 'A' {
			continue
		}
		currentNodes[k] = 0
		currentNode := k
		for _ = 0; currentNode[2] != 'Z'; currentNodes[k]++ {
			instruction := instructions[(currentNodes[k])%len(instructions)]

			currentNode = nodes[currentNode][instruction]
		}
	}
	rounds := math.LCM(collections.MapValues(currentNodes)...)
	return problem.IntAnswer(rounds), nil
}
