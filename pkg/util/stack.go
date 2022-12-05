package util

type Stack[T any] struct {
	slice  *[]T
	Push   func(T)
	Pop    func() T
	Length func() int
	PopN   func(n int) []T
}

func MakeStack[T any]() Stack[T] {
	slice := make([]T, 0)
	return Stack[T]{
		slice: &slice, // To easily access it for debugging.
		PopN: func(n int) []T {
			tail := len(slice) - 1
			res := slice[tail-n+1:]
			slice = slice[:tail-n+1]
			return res
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
