package common

func RemoveFromSlice(slice []int, s int) []int {
	return append(slice[:s], slice[s+1:]...)
}
