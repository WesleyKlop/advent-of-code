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
		return problem.NoAnswer, err
	}
	sum := 0
	for _, line := range lines {
		game := game{}
		meta, rawRounds, found := strings.Cut(line, ":")
		if !found {
			panic("illegal line")
		}
		_, err := fmt.Sscanf(meta, "Game %d", &game.Id)
		if err != nil {
			return nil, err
		}

		for _, round := range strings.Split(rawRounds, ";") {
			shownMap := make(map[string]int, len(round))
			for _, shown := range strings.Split(round, ", ") {
				var key string
				var val int
				_, err := fmt.Sscanf(shown, "%d %s", &val, &key)
				if err != nil {
					return nil, err
				}
				shownMap[key] = val
				switch {
				case key == "red" && game.RedCubeCount < val:
					game.RedCubeCount = val
				case key == "blue" && game.BlueCubeCount < val:
					game.BlueCubeCount = val
				case key == "green" && game.GreenCubeCount < val:
					game.GreenCubeCount = val
				}
			}
			game.Shown = append(game.Shown, shownMap)
		}

		sum += game.Power()
	}

	return problem.IntAnswer(sum), nil
}
