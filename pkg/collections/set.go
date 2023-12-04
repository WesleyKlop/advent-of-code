package collections

import "maps"

var entry = struct{}{}

type Set[T comparable] struct {
	content map[T]struct{}
}

func (s Set[T]) Has(val T) bool {
	_, exists := s.content[val]
	return exists
}

func (s Set[T]) Add(val T) {
	s.content[val] = entry
}

func (s Set[T]) Len() int {
	return len(s.content)
}

func (s Set[T]) Clone() Set[T] {
	return Set[T]{content: maps.Clone(s.content)}
}

func (s Set[T]) Values() []T {
	v := make([]T, 0, len(s.content))
	for k, _ := range s.content {
		v = append(v, k)
	}
	return v
}

func NewSet[T comparable]() Set[T] {
	return Set[T]{
		content: map[T]struct{}{},
	}
}

func NewSetFromSlice[T comparable](slice []T) Set[T] {
	content := make(map[T]struct{}, len(slice))
	for _, t := range slice {
		content[t] = entry
	}
	return Set[T]{content: content}
}
