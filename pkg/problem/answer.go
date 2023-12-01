package problem

import "fmt"

type Answer interface {
	Display()
}

type IntAnswer int

func (i IntAnswer) Display() {
	fmt.Printf("Answer: %d\n", i)
}

type StringAnswer string

func (s StringAnswer) Display() {
	fmt.Printf("Answer: %s\n", s)
}

type noAnswer struct{}

func (n noAnswer) Display() {
	panic("Failed to solve this puzzle")
}

var NoAnswer Answer = noAnswer{}
