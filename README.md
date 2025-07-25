# Installation

## API Platform

```bash
cd backend
composer install
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
symfony serve

php bin/console doctrine:fixtures:load
```

## Vue

```bash
cd frontend
npm install
npm run dev
```

### Compte admin

```bash
php bin/console app:create-admin admin@example.com
```
