package problem

import (
	"fmt"
)

type ErrAnswer struct {
	error
}

func (i ErrAnswer) Display() {
	fmt.Printf("Answer: %v\n", i.Error())
}

func (i ErrAnswer) String() string {
	return i.Error()
}
