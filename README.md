# Setup
```shell
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan serve
```

# Branch rule
- frontend: UI only
- backend: logic + database
