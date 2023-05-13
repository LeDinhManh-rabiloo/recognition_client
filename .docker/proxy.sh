#!/bin/bash

ROOT_DIR="$( cd `dirname $0` ; cd .. ; pwd -P )"

DB_USERNAME=${1:-"dbmaster"}
DB_PASSWORD=${2:-"$(head /dev/urandom | tr -dc A-Za-z0-9 | head -c 13 ; echo '')"}

__gen_file() {
    if [[ ! -f $ROOT_DIR/$1 ]]; then
        sed "s/DB_USERNAME/${DB_USERNAME}/g; s/DB_PASSWORD/${DB_PASSWORD}/g" $ROOT_DIR/.docker/$1 > $ROOT_DIR/$1
    fi
}

__gen_file proxy.yml
__gen_file proxy.json

set -ex

docker-compose -f proxy.yml up -d
