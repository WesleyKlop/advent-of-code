package math

// GCD finds greatest common divisor via Euclidean algorithm
func GCD(a, b int) int {
	for b != 0 {
		t := b
		b = a % b
		a = t
	}
	return a
}

// LCM finds Least Common Multiple via GCD
func LCM(n ...int) int {
	result := n[0] * n[1] / GCD(n[0], n[1])

	for i := 2; i < len(n); i++ {
		result = LCM(result, n[i])
	}

	return result
}
