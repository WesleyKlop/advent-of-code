package input

type Input struct {
	path string
}

func NewInput(path string) (Input, error) {
	return Input{
		path: path,
	}, nil
}
