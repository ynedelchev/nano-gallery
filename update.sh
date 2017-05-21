#!/bin/bash

CUR=`pwd`
DIR=`dirname "$0"`
cd "$DIR"
DIR=`pwd`
cd "$CUR"


cd "$DIR/albums"
for d in * ; do
    if [ -d "$d" ] 
    then
       echo "Copying $d"
       cp "$DIR/album.php" "$DIR/albums/$d/index.php"
    fi
done
cd "$CUR"
