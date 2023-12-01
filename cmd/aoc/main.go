package main

import (
	"flag"
	"log/slog"

	"github.com/wesleyklop/advent-of-code/internal/solvers"
	"github.com/wesleyklop/advent-of-code/pkg/aoc"
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

func main() {
	inputType := aoc.PuzzleInput
	if test > 0 {
		inputType = aoc.TestInput(test)
	}
	solver, err := solvers.GetSolver(year, day, inputType)
	if err != nil {
		slog.Error("failed to create solver", "err", err)
		return
	}

	a1, err := solver.SolvePart1()
	if err != nil {
		slog.Error("failed to solve part 1", "err", err)
		return
	}
	a1.Display()

	a2, err := solver.SolvePart2()
	if err != nil {
		slog.Error("failed to solve part 2", "err", err)
		return
	}
	a2.Display()
}
