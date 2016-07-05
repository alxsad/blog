#!/bin/bash
echo "Current working directory: '"$(pwd)"'"
docker run --rm -i -v $(pwd):/app alxsad/phpspec $@
