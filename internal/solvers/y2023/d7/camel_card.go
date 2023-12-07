package d7

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

type camelCard struct {
	Hand []string
	Bid  int
	Type handType
}
