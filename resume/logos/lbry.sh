#!/bin/bash
convert lbry_original.png -gravity center -resize 256x256 -extent 512x512 -threshold 50% -negate -transparent black lbry.png
