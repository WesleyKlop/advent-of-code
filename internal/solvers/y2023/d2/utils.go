package d2

type game struct {
	Id int

	RedCubeCount   int
	BlueCubeCount  int
	GreenCubeCount int
}

func (g game) Power() int {
	return g.BlueCubeCount * g.RedCubeCount * g.GreenCubeCount
}
