#!/bin/sh

echo "Waiting for database..."

# wait for mysql
while ! php -r "
try {
    new PDO('mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'),
    getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    exit(0);
} catch (Exception \$e) {
    exit(1);
}
"; do
  sleep 2
done

echo "Database ready"

# generate key if missing
if [ ! -f ".env" ]; then
    cp .docker/php/.env.example .env
fi

php artisan key:generate --force

# run migrations
php artisan migrate --force

# cache config/routes (optional but recommended)
php artisan config:cache
php artisan route:cache

# run container main command
exec "$@"
