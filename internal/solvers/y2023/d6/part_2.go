package d6

import (
	"context"
	"strconv"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part2(_ context.Context, inp input.Input) (problem.Answer, error) {
	time, distance := parseInput2(inp.MustReadLines())

	winningOptions := 0
	for buttonHeldTime := 1; buttonHeldTime < time; buttonHeldTime++ {
		remainingTime := time - buttonHeldTime
		// buttonHeldTime is also the speed
		distanceTraveled := remainingTime * buttonHeldTime
		if distanceTraveled > distance {
			winningOptions++
		}
	}

	return problem.IntAnswer(winningOptions), nil
}

func parseInput2(inp []string) (int, int) {
	rawTimes := strings.Fields(inp[0])[1:]
	rawDistances := strings.Fields(inp[1])[1:]

	time, _ := strconv.Atoi(strings.Join(rawTimes, ""))
	distance, _ := strconv.Atoi(strings.Join(rawDistances, ""))

	return time, distance
}
