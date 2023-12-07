package d7

import (
	"fmt"
	"strings"
)

type handType int

const (
	fiveOfAKind handType = iota
	fourOfAKind
	fullHouse
	threeOfAKind
	twoPair
	onePair
	highCard
)
const (
	jokerValuePart1 = 11
	jokerValuePart2 = 1
)

type camelCard struct {
	Hand []string
	Bid  int
	Type handType
}

func cardStrength(card string, jokerValue int) int {
	if card == "J" {
		return jokerValue
	}
	return map[string]int{
		"A": 14,
		"K": 13,
		"Q": 12,
		// J: 11
		"T": 10,
		"9": 9,
		"8": 8,
		"7": 7,
		"6": 6,
		"5": 5,
		"4": 4,
		"3": 3,
		"2": 2,
		// J: 1
	}[card]
}

func parseCards(lines []string, determineHandType func([]string) handType) []camelCard {
	camelCards := make([]camelCard, 0, len(lines))
	for _, line := range lines {
		card := camelCard{}
		rawHand := ""
		_, _ = fmt.Sscanf(line, "%s %d", &rawHand, &card.Bid)
		card.Hand = strings.Split(rawHand, "")
		card.Type = determineHandType(card.Hand)
		camelCards = append(camelCards, card)
	}
	return camelCards
}

func calculateTotalWinnings(cards []camelCard) int {
	totalWinnings := 0
	for idx, card := range cards {
		rank := len(cards) - idx
		totalWinnings += rank * card.Bid
	}
	return totalWinnings
}

func sortCardsFunc(jokerValue int) func(a, b camelCard) int {
	return func(a, b camelCard) int {
		if a.Type < b.Type {
			return -1
		}
		if a.Type > b.Type {
			return 1
		}

		for i := 0; i < 5; i++ {
			aCard, bCard := cardStrength(a.Hand[i], jokerValue), cardStrength(b.Hand[i], jokerValue)
			if aCard > bCard {
				return -1
			}
			if aCard < bCard {
				return 1
			}
		}

		return 0
	}
}
