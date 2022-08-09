#!/bin/sh
set -e 

rm -rf src/*.php

php generate.php $1

THREADS=$2 docker compose up
