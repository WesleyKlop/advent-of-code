package problem

import (
	"fmt"
)

type Answer interface {
	fmt.Stringer

	Display()
}
