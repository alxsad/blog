#!/bin/bash
echo "Current working directory: '"$(pwd)"'"
docker run --rm -i -t alxsad/psysh /usr/local/bin/psysh
