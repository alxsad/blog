#!/bin/bash
echo "Current working directory: '"$(pwd)"'"
docker run --rm -v $(pwd):/app composer/composer $@
