package day2

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"strings"
)

type Solver struct {
	Input *util.Input
}

var (
	ScoreRock        = 1
	ScorePaper       = 2
	ScoreScissors    = 3
	ScoreWin         = 6
	ScoreDraw        = 3
	OpponentRock     = "A"
	OpponentPaper    = "B"
	OpponentScissors = "C"
	PlayerRock       = "X"
	PlayerPaper      = "Y"
	PlayerScissors   = "Z"
	WantsLose        = "X"
	WantsDraw        = "Y"
	WantsWin         = "Z"
)

func (s *Solver) Parse() [][]string {
	return util.Map(s.Input.Lines(), func(t string) []string {
		return strings.Split(t, " ")
	})
}

func scoreForShape(shape string) int {
	if shape == PlayerRock {
		return ScoreRock
	}
	if shape == PlayerPaper {
		return ScorePaper
	}
	if shape == PlayerScissors {
		return ScoreScissors
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

func resultForMove(wantedResult string, opponent string) string {
	if wantedResult == WantsWin && opponent == OpponentScissors {
		return PlayerRock
	}
	if wantedResult == WantsWin && opponent == OpponentPaper {
		return PlayerScissors
	}
	if wantedResult == WantsWin && opponent == OpponentRock {
		return PlayerPaper
	}
	if wantedResult == WantsDraw && opponent == OpponentScissors {
		return PlayerScissors
	}
	if wantedResult == WantsDraw && opponent == OpponentPaper {
		return PlayerPaper
	}
	if wantedResult == WantsDraw && opponent == OpponentRock {
		return PlayerRock
	}
	if wantedResult == WantsLose && opponent == OpponentScissors {
		return PlayerPaper
	}
	if wantedResult == WantsLose && opponent == OpponentPaper {
		return PlayerRock
	}
	if wantedResult == WantsLose && opponent == OpponentRock {
		return PlayerScissors
	}
	panic("Invalid input")
}

func (s *Solver) SolvePartOne(ctx context.Context) (*int, error) {
	guide := s.Parse()
	score := 0

	for _, round := range guide {
		opponent := round[0]
		player := round[1]
		result := playerWon(player, opponent)
		score += scoreForShape(player)
		if result == 1 {
			score += ScoreWin
		}
		if result == 0 {
			score += ScoreDraw
		}
	}

	return &score, nil
}

func (s *Solver) SolvePartTwo(ctx context.Context) (*int, error) {
	guide := s.Parse()
	score := 0

	for _, round := range guide {
		opponent := round[0]
		wantedResult := round[1]
		player := resultForMove(wantedResult, opponent)
		//fmt.Printf("Opponent: %s, wanted: %s, player: %s\n", opponent, wantedResult, player)
		result := playerWon(player, opponent)
		score += scoreForShape(player)
		if result == 1 {
			score += ScoreWin
		}
		if result == 0 {
			score += ScoreDraw
		}
	}

	return &score, nil
}
