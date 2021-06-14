#!/bin/bash
convert srht_original.png -gravity center -resize 256x256 -extent 512x512 -background white -flatten -negate -threshold 50% -transparent black srht.png
