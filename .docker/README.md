# Docker environment (PHP 8.4 + MySQL + Redis + Nginx + Queue)

This project includes a Docker Compose setup for running Open MBO with:

- PHP-FPM `8.4` (application container)
- Nginx (serves HTTP)
- MySQL (`mysql:latest`)
- Redis (`redis:latest`) for Laravel cache + queue
- Queue worker container (`php artisan queue:work`)

## Prerequisites

- Docker + Docker Compose v2 (`docker compose`)

## Quick start

From the project root:

```bash
docker compose up -d --build
```

The app will be available at:

- `http://localhost:8080`

### Environment variables

- The containers set sane defaults via `docker-compose.yml` (DB host, Redis, cache/queue drivers).
- If you don't have an `.env`, the PHP container will create one from `.docker/php/.env.example` on first start.

## Services / Ports

- Nginx: `localhost:8080`
- MySQL: `localhost:33006` (container port `3306`)
  - user: `laravel`
  - pass: `secret`
  - db: `open-mbo`
  - root pass: `root`
- Redis: `localhost:6379`

## Queue worker

The `queue` service runs:

```bash
php artisan queue:work --sleep=3 --tries=3 --timeout=90
```

By default this stack uses Redis queues (`QUEUE_CONNECTION=redis`).

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

This setup is internally consistent (containers, networking, env vars, queue worker, and Nginx ⇄ PHP-FPM wiring).
However, it depends on upstream images and package compatibility:

- If `php:8.4-fpm` is not available on your machine/registry, the build will fail (pin to `8.3`).
- `mysql:latest` can introduce breaking changes across major releases; if you hit issues, pin a specific MySQL version.
