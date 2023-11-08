#!/bin/sh

set -e

echo 'running prestart node script'
echo 'running npm install'
npm install -f

echo 'initialization done, start watching'
# npm install browser-sync browser-sync-webpack-plugin@2.0.1 --save-dev --production=false

# npm run watch