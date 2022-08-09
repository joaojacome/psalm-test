#!/bin/sh
set -eu

if [[ "$#" != 2 || "$1" = "" || "$2" = "" ]]; then
  echo "Usage: $0 <files> <threads>"
  exit 1
fi

rm -rf src/*.php

composer require vimeo/psalm:"5.0.0-beta1"

php generate.php $1

THREADS=$2 docker compose up
