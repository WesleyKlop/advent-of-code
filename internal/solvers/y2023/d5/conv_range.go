package d5

type convRange struct {
	SrcStart  int
	DestStart int
	Range     int
}

func (cr convRange) SrcBounds() (int, int) {
	return cr.SrcStart, cr.SrcStart + cr.Range
}

func (cr convRange) DestBounds() (int, int) {
	return cr.DestStart, cr.DestStart + cr.Range
}

func (cr convRange) IsInSrcRange(intermediate int) bool {
	return cr.SrcStart < intermediate && intermediate < cr.SrcStart+cr.Range
}

func (cr convRange) Convert(src int) int {
	offset := src - cr.SrcStart
	return cr.DestStart + offset
}
