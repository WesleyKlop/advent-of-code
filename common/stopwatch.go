package common

import "time"

type Stopwatch struct {
	start    time.Time
	lastTick *time.Time
}

func NewStopwatch() Stopwatch {
	t := time.Now()
	return Stopwatch{
		start:    t,
		lastTick: &t,
	}
}

func (sw *Stopwatch) Total() time.Duration {
	return time.Since(sw.start)
}

func (sw *Stopwatch) Click() time.Duration {
	var cmpTime = *sw.lastTick

	newTime := time.Now()
	diff := newTime.Sub(cmpTime)
	sw.lastTick = &newTime

	return diff
}
