package util

func Chunk[T any](list []T, size int) [][]T {
	if len(list)%size != 0 {
		// Remove this if this is fine
		panic("Cannot chunk evenly")
	}
	chunks := make([][]T, len(list)/size)
	for idx := range chunks {
		chunks[idx] = make([]T, size)
		for cIdx := range chunks[idx] {
			chunks[idx][cIdx] = list[idx*size+cIdx]
		}
	}
	return chunks
}
