package util

type Stack[T any] struct {
	Push   func(T)
	Pop    func() T
	Length func() int
	Peek   func() []T
}

func MakeStack[T any]() Stack[T] {
	slice := make([]T, 0)
	return Stack[T]{
		Peek: func() []T {
			return slice
		},
		Push: func(i T) {
			slice = append(slice, i)
		},
		Pop: func() T {
			res := slice[len(slice)-1]
			slice = slice[:len(slice)-1]
			return res
		},
		Length: func() int {
			return len(slice)
		},
	}
}
