#!/usr/bin/env sh

updated=false

if [ -n "$UID" ]; then
    echo "Updating www-data UID to $UID"
    usermod -u "$UID" www-data
    updated=true
fi

if [ -n "$GID" ]; then
    echo "Updating www-data GID to $GID"
    groupmod -g "$GID" www-data
    updated=true
fi

if [ "$updated" = true ]; then
    echo "Reapply folders ownership to www-data"
    chown -R www-data:www-data /var/www/html /home/www-data
fi

su-exec "www-data" "${@}"
