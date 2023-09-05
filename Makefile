PORT ?= 8000

start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT) -t public

install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 public app routes tests

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml	

test:
	composer exec --verbose phpunit tests -- --coverage-text