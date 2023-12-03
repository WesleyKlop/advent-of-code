package collections

var deltas = [][]int{
	{-1, -1}, {-1, 0}, {-1, 1},
	{0, -1} /*{0, 0}, */, {0, 1},
	{1, -1}, {1, 0}, {1, 1},
}

func ForEachSurroundingCell[T any](grid [][]T, eachFn func(val T, surrounding T)) {
	for rIdx, row := range grid {
		for cIdx, col := range grid[rIdx] {
			for _, delta := range deltas {
				offsetRow, offsetCol := delta[0]+rIdx, delta[1]+cIdx

				if offsetRow < 0 || offsetRow >= len(grid) {
					continue
				}

				if offsetCol < 0 || offsetCol >= len(row) {
					continue
				}

				eachFn(col, grid[offsetRow][offsetCol])
			}
		}
	}
}
