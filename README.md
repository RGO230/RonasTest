run cp .env.example .env
run docker-compose up -d --build
run docker-compose exec app php artisan migrate
run docker-compose exec app php artisan l5-swagger:generate
