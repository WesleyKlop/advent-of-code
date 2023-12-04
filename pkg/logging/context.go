package logging

import (
	"context"
	"log/slog"
)

type key string

var loggerKey key = "logger"

func ContextWithLogger(ctx context.Context, logger *slog.Logger) context.Context {
	return context.WithValue(ctx, loggerKey, logger)
}

func ContextWith(ctx context.Context, args ...any) context.Context {
	logger := FromContext(ctx)
	return ContextWithLogger(ctx, logger.With(args...))
}

func FromContext(ctx context.Context) *slog.Logger {
	return ctx.Value(loggerKey).(*slog.Logger)
}
