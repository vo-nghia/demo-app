#!/bin/sh
cd /var/www/backend/

cp .env.local .env
#sed -i -e "/^BUGSNAG_RELEASE_STAGE=/d" .env
#sed -i -e "/^BUGSNAG_API_KEY=/d" .env


# composerの実行
export COMPOSER_ALLOW_SUPERUSER=1

php -d memory_limit=-1 /usr/bin/composer --no-interaction install

# マイグレーション＆seederの実行
php artisan migrate
php artisan migrate:fresh --seed

# キャッシュクリア
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# execute shopify inital sync
php artisan shopify:sync

chown -R www:www /var/www/backend

