package problem

import (
	"context"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
	"strconv"
)

type IntAnswer int

func (i IntAnswer) Display(ctx context.Context) {
	logger := logging.FromContext(ctx)
	logger.Info("Answer is", "value", i)
}

func (i IntAnswer) String() string {
	return strconv.FormatInt(int64(i), 10)
}
