#!/bin/bash

source /var/www/html/.env

if [ $# -lt 2 ]; then
	echo "No arguments. Usage: <bundle name> <bundle source path>"
	exit 1
fi

NAME=$1
SOURCE=$2


if [ ! -d "$SOURCE" ]; then
	echo "No bundle source given!"
	exit 1
fi

TARBALL_NAME="${NAME}.tar.gz"
#BUNDLE_NAME="encoded_${NAME}.b64"

echo "Creating Bundle [$TARBALL_NAME]"

tar -czvf "$TARBALL_NAME" -C "$SOURCE" .

if [ $? -ne 0 ]; then
	echo "ERROR: could not create bundle"
	exit 1
fi

#base64 "$TARBALL_NAME" > "$BUNDLE_NAME"

#echo "$NAME $BUNDLE_NAME"

#this is for if rabbitmq integrated
#php bundler.php "$NAME" "$TARBALL_NAME"

scp test@deploynode "$TARBALL_NAME /var/www/html/bundles/$TARBALL_NAME"
php bundler.php "$NAME"
#sshpass -p "$DEPLOY_PASS" ssh test@deploynode "php /var/www/html/deploy-bundler.php $NAME"
