package d7

import (
	"context"
	"slices"

	"github.com/wesleyklop/advent-of-code/pkg/collections"
	"github.com/wesleyklop/advent-of-code/pkg/input"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"github.com/wesleyklop/advent-of-code/pkg/problem"
)

func handTypeFromHandPart2(hand []string) handType {
	cardCountByType := collections.CountValues(hand)

	if jCount, ok := cardCountByType["J"]; ok {
		// Transform the J to the most common card in the set
		maxCount := 0
		maxType := ""
		for typ, count := range cardCountByType {
			if typ != "J" && count > maxCount {
				maxCount = count
				maxType = typ
			}
		}
		cardCountByType[maxType] += jCount
		delete(cardCountByType, "J")
	}

	groups := collections.MapValues(cardCountByType)
	// Shortcut
	switch len(groups) {
	case 1:
		return fiveOfAKind
	case 4:
		return onePair
	case 5:
		return highCard
	}
	// Four of a kind or full house
	if len(groups) == 2 {
		if groups[0] == 4 || groups[1] == 4 {
			return fourOfAKind
		}
		return fullHouse
	}
	// Three of a kind or two pair
	if len(groups) == 3 {
		if groups[0] == 3 || groups[1] == 3 || groups[2] == 3 {
			return threeOfAKind
		}
		return twoPair
	}
	panic("Invalid hand!?")
}

func part2(ctx context.Context, inp input.Input) (problem.Answer, error) {
	logger := logging.FromContext(ctx)
	camelCards := parseCards(inp.MustReadLines(), handTypeFromHandPart2)

	logger.Info("parsed", "cards", camelCards)
	slices.SortFunc(camelCards, sortCardsFunc(jokerValuePart2))
	logger.Info("sorted", "cards", camelCards)

	return problem.IntAnswer(calculateTotalWinnings(camelCards)), nil
}
