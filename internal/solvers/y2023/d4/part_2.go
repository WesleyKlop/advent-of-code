package d4

import (
	"context"
	"fmt"
	"slices"
	"strings"

	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

type cardData struct {
	Id             int
	WinningNumbers collections.Set[int]
	CardNumbers    collections.Set[int]
}

func part2(ctx context.Context, inp input.Input) (problem.Answer, error) {
	logger := logging.FromContext(ctx)
	lines := inp.MustReadLines()
	cardsStack := make([]cardData, 0, len(lines))
	for _, line := range lines {
		meta, data, _ := strings.Cut(line, ": ")
		var cardId int
		_, err := fmt.Sscanf(meta, "Card %d", &cardId)
		if err != nil {
			panic(err)
		}
		rawWinningNr, rawMyNr, _ := strings.Cut(strings.TrimSpace(data), " | ")
		winningNr := collections.NewSetFromSlice(
			collections.MapStringsToInt(strings.Fields(rawWinningNr)),
		)
		myNr := collections.NewSetFromSlice(
			collections.MapStringsToInt(strings.Fields(rawMyNr)),
		)
		card := cardData{
			Id:             cardId,
			WinningNumbers: winningNr,
			CardNumbers:    myNr,
		}
		logger.Debug("Parsed card", "card", card)
		cardsStack = append(cardsStack, card)
	}

	cardsCount := 0
	queue := slices.Clone(cardsStack)
	var card cardData
	for len(queue) > 0 {
		cardsCount++
		card, queue = queue[0], queue[1:]

		wonCards := 0
		for _, nr := range card.CardNumbers.Values() {
			if card.WinningNumbers.Has(nr) {
				wonCards++
			}
		}
		if wonCards > 0 {
			queue = append(queue, cardsStack[card.Id:card.Id+wonCards]...)
		}
	}

	return problem.IntAnswer(cardsCount), nil
}
