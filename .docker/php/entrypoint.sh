#!/bin/sh

set -e

if [ ! -f ".env" ]; then
    cp .docker/php/.env.example .env
fi

if [ -f ".env" ] && ! grep -q "^APP_KEY=base64:" .env; then
    php artisan key:generate --force
fi

if [ "${DB_CONNECTION:-mysql}" = "mysql" ]; then
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

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-interaction --prefer-dist
fi

php artisan storage:link || true

chown -R www-data:www-data storage bootstrap/cache || true


# run container main command
exec "$@"
