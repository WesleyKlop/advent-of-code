package collections

func MapValues[T any, K comparable](source map[K]T) []T {
	out := make([]T, 0, len(source))
	for _, v := range source {
		out = append(out, v)
	}
	return out
}

func MapKeys[T any, K comparable](source map[K]T) []K {
	out := make([]K, 0, len(source))
	for k := range source {
		out = append(out, k)
	}
	return out
}
