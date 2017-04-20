composer:
	composer install

fixtures:
	php bin/console doctrine:database:drop --if-exists --force --no-debug
	php bin/console doctrine:database:create --no-debug
	make migrations
	php bin/console doctrine:fixtures:load --append --no-debug

migrations:
	php bin/console doctrine:migrations:migrate --no-debug --no-interaction

init_dev: composer fixtures clean build_front_dev

init: composer migrations

clean_cache:
	rm -Rf var/cache/*
	rm -Rf var/logs/*

clean:
	make clean_cache
	rm -rf app/tmp/*

build_front_dev:
	yarn
