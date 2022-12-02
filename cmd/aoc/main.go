package main

import (
	"context"
	"flag"
	"fmt"
	"github.com/wesleyklop/advent-of-code/pkg/solvers"
	"log"
	"os"
	"strconv"
)

type Args struct {
	Year     *int
	Day      *int
	InputDir *string
	Test     *bool
}

func (a *Args) InputFile() string {
	file := "input"
	if *a.Test == true {
		file = "test"
	}
	return fmt.Sprintf("%s/day%d/%s.txt", *a.InputDir, *a.Day, file)
}

func getArgs() (args *Args, err error) {
	args = &Args{}
	args.Year = flag.Int("year", 2022, "The year to solve")
	args.Test = flag.Bool("test", false, "Use test input")
	args.InputDir = flag.String("input-dir", "./inputs", "Where to find input")

	flag.Parse()
	if *args.Year != 2022 {
		err = fmt.Errorf("invalid year %d", *args.Year)
		return nil, err
	}
	if flag.NArg() < 1 {
		err = fmt.Errorf("missing required argument day")
		return nil, err
	}
	argv := flag.Args()

	if dayVal, err := strconv.Atoi(argv[0]); err != nil {
		err = fmt.Errorf("%s is not a valid number", argv[0])
		return nil, err
	} else {
		args.Day = &dayVal
	}

	if *args.Day < 1 || *args.Day > 31 {
		err = fmt.Errorf("invalid day %d", *args.Day)
		return nil, err
	}
	return
}

func main() {
	ctx, cancel := context.WithCancel(context.Background())
	defer cancel()

	args, err := getArgs()
	l := log.New(os.Stderr, "", log.LstdFlags|log.Lshortfile)

	if err != nil {
		l.Println(err.Error())
		os.Exit(1)
	}

	fmt.Printf("Executing day %d in %d\n", *args.Day, *args.Year)

	solver := solvers.GetSolver(*args.Day)

	input, err := os.ReadFile(args.InputFile())
	if err != nil {
		panic(err)
	}
	inputStr := string(input)
	ans, err := solver.SolvePartOne(ctx, &inputStr)
	if err != nil {
		panic(err)
	}
	fmt.Printf("The answer to part 1 is %d\n", ans)

	ans, err = solver.SolvePartTwo(ctx, &inputStr)
	if err != nil {
		panic(err)
	}
	fmt.Printf("The answer to part 2 is %d\n", ans)
}
