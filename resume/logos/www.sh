#!/bin/bash
convert www_original.png -gravity center -resize 300x300 -extent 512x512 -negate -threshold 50% -transparent black www.png
