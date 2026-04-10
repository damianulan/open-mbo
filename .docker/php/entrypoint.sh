#!/bin/sh

set -e

role="${APP_ROLE:-app}"

if [ ! -f ".env" ]; then
    cp .docker/php/.env.example .env
fi

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-interaction --prefer-dist
fi

if [ "${DB_CONNECTION:-mysql}" = "mysql" ] && [ "$role" = "app" ]; then
    echo "Waiting for database..."

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
fi

if [ -f ".env" ] && ! grep -q "^APP_KEY=base64:" .env; then
    php artisan key:generate
fi

git config --global --add safe.directory /var/www
chown -R www-data:www-data storage bootstrap/cache
php artisan storage:link

if [ "${RUN_MIGRATIONS:-0}" = "1" ] && [ "$role" = "app" ]; then
    php artisan migrate
fi

if [ "${RUN_OPTIMIZE:-0}" = "1" ] && [ "$role" = "app" ]; then
    php artisan optimize
fi

if [ "$role" = "queue" ]; then
    exec php artisan queue:work --sleep=3 --tries=3 --timeout=360
fi

if [ "$role" = "scheduler" ]; then
    exec php artisan schedule:work
fi

# run container main command
exec "$@"
