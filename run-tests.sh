#!/bin/bash
echo "Current working directory: '"$(pwd)"'"
docker run --rm -v $(pwd):/app alxsad/phpspec run
