package timing

import (
	"log/slog"
	"time"
)

func Track(start time.Time, logger *slog.Logger) {
	elapsed := time.Since(start)
	logger.Info("Measured execution", "duration", elapsed)
}
