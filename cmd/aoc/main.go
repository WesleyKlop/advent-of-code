package main

import (
	"context"
	"flag"

	"github.com/wesleyklop/advent-of-code/internal/solvers"
	"github.com/wesleyklop/advent-of-code/pkg/aoc"
	"github.com/wesleyklop/advent-of-code/pkg/errors"
	"github.com/wesleyklop/advent-of-code/pkg/logging"
)

var (
	year  = aoc.Y2023
	day   = aoc.Day(3)
	test  = 0
	debug = false
)

func init() {
	flag.Var(&day, "day", "day to solve for")
	flag.Var(&year, "year", "year to solve for")
	flag.IntVar(&test, "test", 0, "which test case to use")
	flag.BoolVar(&debug, "debug", false, "enable debug output")

	flag.Parse()
}

func main() {
	logger := logging.NewConsole(logging.LevelFromBool(debug))
	ctx, cancel := context.WithCancel(context.Background())
	defer cancel()
	ctx = logging.AddToContext(ctx, logger)

	defer errors.PanicHandler(logger)
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

	ctx = logging.AddToContext(ctx, logger.With("part", 1))
	a1, err := solver.SolvePart1(ctx)
	if err != nil {
		logger.Error("failed to solve part 1", "err", err)
		return
	}
	a1.Display(ctx)

	ctx = logging.AddToContext(ctx, logger.With("part", 2))
	a2, err := solver.SolvePart2(ctx)
	if err != nil {
		logger.Error("failed to solve part 2", "err", err)
		return
	}
	a2.Display(ctx)
}
