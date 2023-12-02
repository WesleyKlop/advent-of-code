package problem

import (
	"fmt"
	"strconv"
)

type IntAnswer int

func (i IntAnswer) Display() {
	fmt.Printf("Answer: %d\n", i)
}

func (i IntAnswer) String() string {
	return strconv.FormatInt(int64(i), 10)
}
