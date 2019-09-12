#!/bin/bash

from="/var/lib/dokku/data/storage/f"
to="/var/lib/dokku/data/storage/thumbs"
tmp="/var/lib/dokku/data/storage/tmp"
THUMBNAIL_SIZE=500

rm "$tmp" -rf

images=`find "$from" -name '*' -exec file {} \; | grep -o -P '^.+: \w+ image' | rev | cut -d: -f2-1000 | rev`

num_images=`echo "$images" | wc -l`

i=1
echo "$images" | while read file; do
  thumb=`echo "$file" | sed "s,^$from,$tmp,g"`.jpg
  thumb_dir=`dirname "$thumb"`
  mkdir -p "$thumb_dir"
  echo -en "Resizing $i/$num_images        \r"
  if [[ "$file" == "$from/galleries/Drawings/0_2019-05-13_ErasableIncAndFriends.png" ]]; then
    convert "$file" -thumbnail "900x900>" "$thumb"
  else
    convert "$file" -thumbnail "${THUMBNAIL_SIZE}x${THUMBNAIL_SIZE}>" "$thumb"
  fi
  i=$((i+1))
done

echo
echo "Done!"

ls -Ab "$to" | while read filename; do
  file="$to/$filename"
  rm "$file" -rf
done
#rm "$to" -rf

ls -Ab "$tmp" | while read filename; do
  mv "$tmp/$filename" "$to/$filename"
done
