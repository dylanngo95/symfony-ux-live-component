# Symfony UX Live Component

## How to run this project?

```bash
cd project 
composer install
npm i
php -S 0.0.0.0:8080 -t ./pub

cd .docker
docker compose up -d

cd ../
php bin/console doctrine:migrations:migrate

```

Go to website http://127.0.0.1:8080/user