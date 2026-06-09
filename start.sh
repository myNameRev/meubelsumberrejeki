#!/usr/bin/env bash
set -e

echo "==> Running database migrations..."
php artisan migrate --force

echo "==> Creating storage symlink..."
php artisan storage:link --force

echo "==> Optimising application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting PHP server..."
php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
