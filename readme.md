# Recognition_PJ

## Installation

```shell
$ cd /path/to/project
$ cp .env .env.example
$ docker-compose -f docker-compose.dev.yml run composer install
$ docker-compose -f docker-compose.dev.yml run node npm install
$ docker-compose -f docker-compose.dev.yml run node npm run dev
$ docker-compose up -d
$ docker-compose exec webapp php artisan app:install --force
```

> *Note*
> If `composer` or `npm` is installed on your development environment, you can use it 
>
> ```
> $ composer install
> $ npm install
> $ npm run dev
> ```


## Fix permissions error

```shell
$ sudo chown -R `whoami`:82 bootstrap/cache storage
$ sudo chmod -R g+w         bootstrap/cache storage
```

## Test

```shell
$ docker-compose exec webapp vendor/bin/phpunit
```

## Check coding convention

```shell
$ docker-compose exec webapp vendor/bin/phpcs --standard=phpcs.xml.dist
```

## Build assets

```shell
$ docker-compose -f docker-compose.dev.yml run node npm run watch
```

