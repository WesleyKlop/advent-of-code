package util

func Reduce[T any, R any](list []T, reducer func(R, T) R, initial R) R {
	out := initial
	for i := range list {
		out = reducer(out, list[i])
	}
	return out
}
