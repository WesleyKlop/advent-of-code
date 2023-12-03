package problem

import (
	"context"
	"fmt"
)

type StringAnswer string

func (s StringAnswer) Display(context.Context) {
	fmt.Printf("Answer: %s\n", s)
}

func (s StringAnswer) String() string {
	return string(s)
}
