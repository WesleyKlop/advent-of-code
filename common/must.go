package common

import (
	"fmt"
	"strconv"
)

func Must[T any](v T, err error) T {
	if err != nil {
		panic(fmt.Errorf("must: %w", err))
	}
	return v
}

func MustParseInt(v string) int {
	return int(Must(strconv.ParseInt(v, 10, 64)))
}

func MustParseFloat(v string) float64 {
	return Must(strconv.ParseFloat(v, 64))
}
