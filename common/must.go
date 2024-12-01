package common

import "fmt"

func Must[T any](v T, err error) T {
	if err != nil {
		panic(fmt.Errorf("must: %w", err))
	}
	return v
}
