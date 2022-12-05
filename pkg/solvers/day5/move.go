package day5

import (
	"github.com/wesleyklop/advent-of-code/pkg/util"
	"strconv"
	"strings"
)

type move struct {
	Amount int
	From   int
	To     int
}

func parseMoves(input []string) []move {
	return util.Map(input, func(row string) move {
		lineSplit := strings.Split(row, " ")
		Amount, _ := strconv.Atoi(lineSplit[1])
		From, _ := strconv.Atoi(lineSplit[3])
		To, _ := strconv.Atoi(lineSplit[5])
		return move{
			Amount: Amount,
			From:   From - 1,
			To:     To - 1,
		}
	})
}
