FROM php:8.1-cli-alpine

RUN docker-php-ext-install posix pcntl

WORKDIR /app
CMD ["php", "/app/vendor/bin/psalm", "--no-cache", "--threads=$THREADS"]

