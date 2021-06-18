#!/bin/bash
convert odysee_original.png -gravity center -resize 300x300 -extent 512x512 -threshold 95% -negate -transparent black odysee.png
#convert odysee_original.png -gravity center -resize 256x256 -extent 512x512 -threshold 95% -negate -transparent black odysee.png
