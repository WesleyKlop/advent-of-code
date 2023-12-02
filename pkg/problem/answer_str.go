package problem

import "fmt"

type StringAnswer string

func (s StringAnswer) Display() {
	fmt.Printf("Answer: %s\n", s)
}

func (s StringAnswer) String() string {
	return string(s)
}
