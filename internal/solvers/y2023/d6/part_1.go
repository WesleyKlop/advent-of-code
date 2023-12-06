package d6

import (
	"context"
	"strconv"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part1(_ context.Context, inp input.Input) (problem.Answer, error) {
	rounds := parseInput(inp.MustReadLines())

	product := 1
	for _, round := range rounds {
		winningOptions := 0
		for buttonHeldTime := 1; buttonHeldTime < round[0]; buttonHeldTime++ {
			remainingTime := round[0] - buttonHeldTime
			// buttonHeldTime is also the speed
			distanceTraveled := remainingTime * buttonHeldTime
			if distanceTraveled > round[1] {
				winningOptions++
			}
		}
		product *= winningOptions
	}

	return problem.IntAnswer(product), nil
}

func parseInput(inp []string) [][2]int {
	rawTimes := strings.Fields(inp[0])[1:]
	rawDistances := strings.Fields(inp[1])[1:]

	out := make([][2]int, 0, len(rawTimes))
	for i := 0; i < len(rawTimes); i++ {
		time, _ := strconv.Atoi(rawTimes[i])
		distance, _ := strconv.Atoi(rawDistances[i])

		out = append(out, [...]int{time, distance})
	}

	return out
}
