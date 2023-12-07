package d7

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

func handTypeFromHand(hand []string) handType {
	groups := collections.MapValues(collections.CountValues(hand))
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

var cardStrength = map[string]int{
	"A": 13,
	"K": 12,
	"Q": 11,
	"J": 10,
	"T": 9,
	"9": 8,
	"8": 7,
	"7": 6,
	"6": 5,
	"5": 4,
	"4": 3,
	"3": 2,
	"2": 1,
}

func part1(ctx context.Context, inp input.Input) (problem.Answer, error) {
	logger := logging.FromContext(ctx)
	lines := inp.MustReadLines()
	camelCards := make([]camelCard, 0, len(lines))
	for _, line := range lines {
		card := camelCard{}
		rawHand := ""
		_, _ = fmt.Sscanf(line, "%s %d", &rawHand, &card.Bid)
		card.Hand = strings.Split(rawHand, "")
		card.Type = handTypeFromHand(card.Hand)
		camelCards = append(camelCards, card)
	}

	logger.Info("parsed", "cards", camelCards)
	slices.SortFunc(camelCards, func(a, b camelCard) int {
		// Primarily order by type
		if a.Type < b.Type {
			return -1
		}
		if a.Type > b.Type {
			return 1
		}

		for i := 0; i < 5; i++ {
			aCard, bCard := cardStrength[a.Hand[i]], cardStrength[b.Hand[i]]
			if aCard > bCard {
				return -1
			}
			if aCard < bCard {
				return 1
			}
		}

		logger.Warn("Hands are exactly the same", "a", a, "b", b)
		return 0
	})
	logger.Info("sorted", "cards", camelCards)

	totalWinnings := 0
	for idx, card := range camelCards {
		rank := len(camelCards) - idx
		totalWinnings += rank * card.Bid
	}

	return problem.IntAnswer(totalWinnings), nil
}
