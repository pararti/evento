env:
	cp .env.example .env
	echo "Please edit .env file"

install:
	docker compose up -d
	docker exec -u www-data -it backend_fpm /usr/local/bin/composer install
	docker exec -it -u www-data backend_fpm ./yii migrate

migrate:
	docker exec -it backend_fpm "yii migrate"

up:
	docker compose up -d

down:
	docker compose down