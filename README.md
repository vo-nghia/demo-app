# Shopify Demo App

## Setup
### Setup project

```bash
git clone git@github.com:vo-nghia/demo-app.git
cd demo-app
```

### Initial server nginx and mysql

```bash
export docker-compose build
docker-compose up -d
```

### Setup BackEnd
```bash
cd web/backend
composer install
cp .env.example .env
php artinsan migrate
```

### Run project
```bash
npm run dev
```

### Develop store
```bash
url: https://accounts.shopify.com
account: vo-nghia@web-life.co.jp/Vannghia1611@@
develop store: vo-nghia-weblife
```
