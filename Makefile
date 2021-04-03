init:
	cp .env.example .env
	docker-compose up -d --build
	docker-compose exec api composer install
	docker-compose exec api composer update
	docker-compose exec api composer dump-autoload
	docker-compose exec api php artisan key:generate
	docker-compose exec api chgrp -R www-data storage bootstrap/cache