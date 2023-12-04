package main

import (
	"context"
	"flag"
	"log/slog"
	"os"
	"time"

	"github.com/phsym/console-slog"
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
	rd := flag.Int("day", int(day), "day to solve for")
	ry := flag.Int("year", int(year), "year to solve for")
	flag.IntVar(&test, "test", 0, "which test case to use")
	flag.BoolVar(&debug, "debug", debug, "enable debug output")

	flag.Parse()

	day = aoc.Day(*rd)
	year = aoc.Year(*ry)
}

func initContext() (context.Context, context.CancelFunc) {
	ctx := context.Background()
	level := slog.LevelInfo
	if debug {
		level = slog.LevelDebug
	}
	ctx = logging.ContextWithLogger(ctx, slog.New(
		console.NewHandler(os.Stdout, &console.HandlerOptions{
			Level:      level,
			TimeFormat: time.TimeOnly,
		}),
	))

	return context.WithCancel(ctx)
	//return signal.NotifyContext(ctx, syscall.SIGINT, syscall.SIGTERM)
}

func main() {
	defer errors.PanicHandler()
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

	ctx = logging.ContextWithLogger(ctx, logger.With("part", 1))
	a1, err := solver.SolvePart1(ctx)
	if err != nil {
		logger.Error("failed to solve part 3", "err", err)
		return
	}
	a1.Display(ctx)

	ctx = logging.ContextWithLogger(ctx, logger.With("part", 2))
	a2, err := solver.SolvePart2(ctx)
	if err != nil {
		logger.Error("failed to solve part 2", "err", err)
		return
	}
	a2.Display(ctx)
}
