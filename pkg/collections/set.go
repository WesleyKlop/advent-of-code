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

func NewSet[T comparable]() Set[T] {
	return Set[T]{
		map[T]struct{}{},
	}
}
