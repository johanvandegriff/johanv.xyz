#!/bin/bash
convert instructables_original.png -gravity center -resize 300x300 -extent 512x512 -negate -threshold 50% instructables.png
#convert instructables_original.png -gravity center -resize 256x256 -extent 512x512 -negate -threshold 50% instructables.png
