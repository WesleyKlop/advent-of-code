package main

import (
	"flag"
	"fmt"
	"log"
	"os"
	"strconv"
)

func getArgs() (year *int, day *int, err error) {
	year = flag.Int("year", 2022, "The year to solve")
	if *year != 2022 {
		err = fmt.Errorf("invalid year %d", *year)
		return nil, nil, err
	}
	flag.Parse()

	if flag.NArg() < 1 {
		err = fmt.Errorf("missing required argument day")
		return nil, nil, err
	}
	args := flag.Args()

	if daynum, err := strconv.Atoi(args[0]); err != nil {
		err = fmt.Errorf("%s is not a valid number", args[0])
		return nil, nil, err
	} else {
		day = &daynum
	}

	if *day < 1 || *day > 31 {
		err = fmt.Errorf("invalid day %d", *day)
		return nil, nil, err
	}
	return
}

func main() {
	year, day, err := getArgs()
	l := log.New(os.Stderr, "", log.LstdFlags|log.Lshortfile)

	if err != nil {
		l.Println(err.Error())
		os.Exit(1)
	}

	fmt.Printf("Executing day %d in %d\n", day, year)

}
