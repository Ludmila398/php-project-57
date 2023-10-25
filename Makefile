PORT ?= 8000

start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT) -t public
	php artisan migrate:fresh --force --seed

install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app routes

test-coverage:
	composer exec --verbose php artisan test -- --coverage-clover build/logs/clover.xml	

test:
	php artisan test

build:
	npm ci && npm run build
		