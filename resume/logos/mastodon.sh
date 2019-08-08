#!/bin/bash
convert mastodon_original.png -background black -gravity center -resize 256x256 -extent 512x512 -threshold 50% -transparent black mastodon.png
