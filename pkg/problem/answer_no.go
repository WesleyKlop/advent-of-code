package problem

import "context"

type noAnswer struct{}

func (n noAnswer) Display(context.Context) {
	panic("Failed to solve this puzzle")
}

func (n noAnswer) String() string {
	return "no answer to this puzzle"
}

var NoAnswer Answer = noAnswer{}
