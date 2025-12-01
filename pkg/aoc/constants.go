package aoc

import (
	"fmt"
	"strconv"
)

type Year int

const (
	Y2023 Year = 2023
)

type Day int

type Part int

const (
	P1 = 1
	P2 = 2
)

func (d *Day) Set(v string) (err error) {
	var parsed int64
	if parsed, err = strconv.ParseInt(v, 10, 8); err != nil {
		return err
	}

	*d = Day(int(parsed))
	return
}
func (y *Year) Set(v string) (err error) {
	var parsed int64
	if parsed, err = strconv.ParseInt(v, 10, 8); err != nil {
		return err
	}

	*y = Year(int(parsed))
	return
}

func (d *Day) String() string {
	if d == nil {
		return ""
	}

	return fmt.Sprintf("%d", d)
}
func (y *Year) String() string {
	if y == nil {
		return ""
	}

	return fmt.Sprintf("%d", y)
}
