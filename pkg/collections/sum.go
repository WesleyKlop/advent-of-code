package collections

func Sum[T ~int](list []T) T {
	var sum T

	for _, val := range list {
		sum += val
	}

	return sum
}
