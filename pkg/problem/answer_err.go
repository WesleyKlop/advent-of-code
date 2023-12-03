package problem

import (
	"context"
	"fmt"
)

type ErrAnswer struct {
	error
}

func (i ErrAnswer) Display(context.Context) {
	fmt.Printf("Answer: %v\n", i.Error())
}

func (i ErrAnswer) String() string {
	return i.Error()
}
