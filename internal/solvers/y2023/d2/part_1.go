package d2

import (
	"context"
	"fmt"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func part1(_ context.Context, inp input.Input) (problem.Answer, error) {
	lines, err := inp.ReadLines()
	if err != nil {
		return problem.NoAnswer, err
	}
	sum := 0
game:
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
			for _, shown := range strings.Split(round, ", ") {
				var key string
				var val int
				_, err := fmt.Sscanf(shown, "%d %s", &val, &key)
				if err != nil {
					return nil, err
				}
				switch {
				case key == "red" && val > 12:
					continue game
				case key == "green" && val > 13:
					continue game
				case key == "blue" && val > 14:
					continue game
				}
			}
		}

		sum += game.Id
	}

	return problem.IntAnswer(sum), nil
}
