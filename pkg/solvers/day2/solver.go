package day2

import (
	"context"
	"strings"
)

type Solver struct{}

var (
	ScoreRock        = 1
	ScorePaper       = 1
	ScoreScissors    = 3
	OpponentRock     = "A"
	OpponentPaper    = "B"
	OpponentScissors = "C"
	PlayerRock       = "X"
	PlayerPaper      = "Y"
	PlayerScissors   = "Z"
)

func (s *Solver) Parse(input *string) [][]string {
	result := make([][]string, 0)
	for _, line := range strings.Split(strings.Trim(*input, "\n"), "\n") {
		result = append(result, strings.Split(line, " "))
	}

	return result
}

func scoreForShape(shape string) int {
	if shape == PlayerRock {
		return 1
	}
	if shape == PlayerPaper {
		return 2
	}
	if shape == PlayerScissors {
		return 3
	}
	panic("Invalid shape")
}

func playerWon(player string, opponent string) int {
	if player == PlayerRock && opponent == OpponentScissors {
		return 1
	}
	if player == PlayerRock && opponent == OpponentPaper {
		return -1
	}
	if player == PlayerRock && opponent == OpponentRock {
		return 0
	}
	if player == PlayerPaper && opponent == OpponentScissors {
		return -1
	}
	if player == PlayerPaper && opponent == OpponentPaper {
		return 0
	}
	if player == PlayerPaper && opponent == OpponentRock {
		return 1
	}
	if player == PlayerScissors && opponent == OpponentScissors {
		return 0
	}
	if player == PlayerScissors && opponent == OpponentPaper {
		return 1
	}
	if player == PlayerScissors && opponent == OpponentRock {
		return -1
	}
	panic("Invalid input")
}

func (s *Solver) SolvePartOne(ctx context.Context, input *string) (int, error) {
	guide := s.Parse(input)
	score := 0

	for _, round := range guide {
		opponent := round[0]
		player := round[1]
		result := playerWon(player, opponent)
		score += scoreForShape(player)
		if result == 1 {
			score += 6
		}
		if result == 0 {
			score += 3
		}
	}

	return score, nil

}

func (s *Solver) SolvePartTwo(ctx context.Context, input *string) (int, error) {
	return 0, nil
}
