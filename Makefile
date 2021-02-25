init:
	docker-compose up -d --build
	docker-compose exec api composer install
	docker-compose exec api php artisan key:generate
	docker-compose exec api chgrp -R www-data storage bootstrap/cache