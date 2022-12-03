package util

import "golang.org/x/exp/constraints"

func Sum[T constraints.Integer](list []T) T {
	return Reduce(list, func(sum T, t T) T {
		return sum + t
	}, 0)
}
