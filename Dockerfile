# ========================
# Get backend vendors
# ========================
FROM composer as vendor

WORKDIR /app

COPY composer.* ./
COPY database ./database
RUN composer install  \
    --ignore-platform-reqs \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --no-suggest \
    --optimize-autoloader \
    --prefer-dist

# ========================
# Build frontend assets
# ========================
FROM node:10-alpine as frontend

RUN apk add --update --no-cache git build-base

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY webpack.mix.js  ./
COPY resources       ./resources
COPY public          ./public

RUN set -eux; \
    mkdir -p ./public/css ./public/js ./public/fonts ./public/img ; \
    npm run production

# ========================
# Build app image
# ========================
FROM registry.rabiloo.net/oanhnn/docker-php:php73-unitd

ENV USER_ID=www-data
WORKDIR /app

COPY                 .docker/start-*      /usr/local/bin/
COPY                 .docker/config.json  /docker-entrypoint.d/config.json
COPY                 .                    /app
COPY --from=vendor   /app/vendor          /app/vendor
COPY --from=frontend /app/public          /app/public

RUN set -eux; \
    chown -R ${USER_ID}:${USER_ID} /app; \
    chmod +x /usr/local/bin/start-* ; \
    su-exec ${USER_ID} php /app/artisan package:discover; \
    su-exec ${USER_ID} php /app/artisan storage:link;
