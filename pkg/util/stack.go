package util

type Stack[T any] struct {
	slice *[]T
}

func (receiver *Stack[T]) Push(val T) {
	*receiver.slice = append(*receiver.slice, val)
}
func (receiver *Stack[T]) Pop() T {
	slice := *receiver.slice
	res := (slice)[len(slice)-1]
	*receiver.slice = (slice)[:len(slice)-1]
	return res
}
func (receiver *Stack[T]) Size() int {
	return len(*receiver.slice)
}

func (receiver *Stack[T]) PopN(n int) []T {
	slice := *receiver.slice
	res := slice[len(slice)-n:]
	*receiver.slice = slice[:len(slice)-n]
	return res
}

func MakeStack[T any]() Stack[T] {
	slice := make([]T, 0)
	return Stack[T]{
		// To easily access it for debugging.
		slice: &slice,
	}
}
