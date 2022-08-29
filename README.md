# Parrot Send

SAAS SMS messaging platform

## Installation
### prerequisite
- Git, PHP8.1, NodeJS v16

## Install
clone this respositor and `cd` into it.
```shell
composer install
cp .env.example .env
# Update DB credentials in .env 
php artisan key:generate
php artisan storage:link
php artisan migrate:fresh --seed

npm install
npm run build #build prod assets
npm run dev #start dev
```

## Testing
```shell
php artisan test
npm run test:cypress
```

## Built with
- Laravel
- VueJS
- TailwindCSS
- InertiaJS
- Vite

## Testing
- Cypress
- PHPUnit

## CI/CD
- AWS
- CircleCI
- Github
- Ansible
- Prometheus
