package problem

type noAnswer struct{}

func (n noAnswer) Display() {
	panic("Failed to solve this puzzle")
}

func (n noAnswer) String() string {
	return "no answer to this puzzle"
}

var NoAnswer Answer = noAnswer{}
