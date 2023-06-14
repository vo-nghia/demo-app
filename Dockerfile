FROM php:8.1-fpm-alpine

ARG SHOPIFY_API_KEY
ENV SHOPIFY_API_KEY=$SHOPIFY_API_KEY

RUN apk update && apk add --update nodejs npm \
    composer php-pdo_sqlite php-pdo_mysql php-pdo_pgsql php-simplexml php-fileinfo php-dom php-tokenizer php-xml php-xmlwriter php-session \
    openrc bash nginx

RUN docker-php-ext-install pdo

# Create the 'www' user and group
RUN addgroup -g 1000 www && adduser -D -G www -u 1000 www

COPY --chown=www:www web /app
WORKDIR /app

# Overwrite default nginx config
COPY web/backend/nginx.conf /etc/nginx/nginx.conf

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN cd frontend && npm install && npm run build
