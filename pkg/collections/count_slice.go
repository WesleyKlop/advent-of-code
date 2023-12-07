package collections

func CountValues[T comparable](slice []T) map[T]int {
	// at most the map is N size
	groups := make(map[T]int, len(slice))
	for _, t := range slice {
		if count, ok := groups[t]; ok {
			groups[t] = count + 1
		} else {
			groups[t] = 1
		}
	}
	return groups
}
