#!/bin/bash

CUR=`pwd`
DIR=`dirname "$0"`
cd "$DIR"
DIR=`pwd`
cd "$CUR"


cd "$DIR/albums"
for d in * ; do
    echo "Copying $d"
    cp "$DIR/album.php" "$DIR/albums/$d/index.php"
done
cd "$CUR"
