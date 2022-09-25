#!/bin/bash

echo "$(date '+%Y-%m-%d %H:%M:%S') INFO: Waiting 10 secs to start consuming the queue..."
sleep 10

php /app/artisan queue:consume
