# Docker environment (Ubuntu + PHP + MySQL + Redis + Nginx + Queue + Scheduler)

This project includes a Docker Compose setup for running Open MBO with:

- Ubuntu-based PHP-FPM container (PHP version controlled by `PHP_VERSION`)
- Nginx (serves HTTP)
- MySQL (`mysql:8.4`)
- Redis (`redis:latest`) for Laravel cache + queue
- Queue worker container (`php artisan queue:work`)
- Scheduler container (`php artisan schedule:work`)

## Prerequisites

- Docker + Docker Compose v2 (`docker compose`)

## Quick start

From the project root:

```bash
docker compose up -d --build
```

The app will be available at:

- `http://localhost:37000`

### Environment variables

- The containers set sane defaults via `docker-compose.yml` (DB host, Redis, cache/queue drivers).
- If you don't have an `.env`, the PHP container will create one from `.docker/php/.env.example` on first start.
- Set `PHP_VERSION` before building if you want a different PHP release, for example `PHP_VERSION=8.3 docker compose up -d --build`.

## Services / Ports

- Nginx: `localhost:37000` (container port `80`)
- MySQL: `localhost:33006` (container port `3306`)
  - user: `laravel`
  - pass: `secret`
  - db: `open-mbo`
  - root pass: `root`
- Redis: `localhost:6379`

## Background workers

The `queue` service runs:

```bash
php artisan queue:work --sleep=3 --tries=3 --timeout=90
```

The `scheduler` service runs:

```bash
php artisan schedule:work
```

By default this stack uses Redis queues (`QUEUE_CONNECTION=redis`) and keeps the PHP-FPM app container focused on serving requests.

## Frontend assets

This stack does not include Node/Vite. If the UI looks unstyled or assets are missing, run on your host machine:

```bash
npm ci
npm run dev
```

## Stopping / resetting

```bash
docker compose down
```

To also remove the MySQL volume:

```bash
docker compose down -v
```

## Notes about "will this work?"

This setup is internally consistent (containers, networking, env vars, queue worker, scheduler, and Nginx ⇄ PHP-FPM wiring).
However, it depends on upstream images and package compatibility:

- The PHP image is built from Ubuntu and installs `php${PHP_VERSION}` packages from Ondrej's PPA, so the requested PHP version must exist there.
- `mysql:latest` can introduce breaking changes across major releases; if you hit issues, pin a specific MySQL version.
  - This repo pins `mysql:8.4` because `mysql:latest` may jump major versions and fail to start against an existing data volume.
