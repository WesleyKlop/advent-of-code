package main

import (
	"context"
	"flag"
	"log/slog"
	"os/signal"
	"syscall"

	"github.com/wesleyklop/advent-of-code/internal/solvers"
	"github.com/wesleyklop/advent-of-code/pkg/aoc"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
)

var (
	year aoc.Year = aoc.Y2023
	day  aoc.Day  = aoc.Day(1)
	test          = 0
)

func init() {
	rd := flag.Int("day", 1, "day to solve for")
	ry := flag.Int("year", aoc.Y2023, "year to solve for")
	flag.IntVar(&test, "test", 0, "which test case to use")

	flag.Parse()

	day = aoc.Day(*rd)
	year = aoc.Year(*ry)
}

func initContext() (context.Context, context.CancelFunc) {
	ctx := context.Background()
	ctx = logging.ContextWithLogger(ctx, slog.Default())

	return signal.NotifyContext(ctx, syscall.SIGINT, syscall.SIGTERM)
}

func main() {
	ctx, cancel := initContext()
	defer cancel()

	logger := logging.FromContext(ctx)
	inputType, ok := aoc.ParseInputType(test)
	if !ok {
		logger.Error("failed to parse input type")
		return
	}

	solver, err := solvers.GetSolver(year, day, inputType)
	if err != nil {
		logger.Error("failed to create solver", "err", err)
		return
	}

	a1, err := solver.SolvePart1(ctx)
	if err != nil {
		logger.Error("failed to solve part 1", "err", err)
		return
	}
	a1.Display()

	a2, err := solver.SolvePart2(ctx)
	if err != nil {
		logger.Error("failed to solve part 2", "err", err)
		return
	}
	a2.Display()
}
