#!/bin/bash
convert peertube_original.png -gravity east -extent 1023x1023 -gravity center -resize 256x256 -extent 512x512 -threshold 50% -negate -transparent black peertube.png
#convert peertube_original.png -gravity center -resize 256x256 -extent 512x512 -threshold 50% -negate peertube.png
