package problem

import (
	"context"
	"fmt"
)

type Answer interface {
	fmt.Stringer

	Display(ctx context.Context)
}
