package d2

import (
	"context"
	"fmt"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part2(_ context.Context, inp input.Input) (problem.Answer, error) {
	lines, err := inp.ReadLines()
	if err != nil {
		return nil, err
	}

	sum := 0
	for _, line := range lines {
		game := game{}
		meta, rawRounds, _ := strings.Cut(line, ":")
		_, _ = fmt.Sscanf(meta, "Game %d", &game.Id)

		for _, round := range strings.Split(rawRounds, ";") {
			for _, shown := range strings.Split(round, ", ") {
				var key string
				var val int
				_, _ = fmt.Sscanf(shown, "%d %s", &val, &key)
				switch {
				case key == "red" && game.RedCubeCount < val:
					game.RedCubeCount = val
				case key == "blue" && game.BlueCubeCount < val:
					game.BlueCubeCount = val
				case key == "green" && game.GreenCubeCount < val:
					game.GreenCubeCount = val
				}
			}
		}

		sum += game.Power()
	}

	return problem.IntAnswer(sum), nil
}
