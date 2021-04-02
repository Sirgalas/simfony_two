include .env
init: down-volume build up

up: memory # create and start containers
	@docker-compose -f ${DOCKER_CONFIG} up -d

down: # stop and destroy containers
	@docker-compose -f ${DOCKER_CONFIG} down

down-volume: #  WARNING: stop and destroy containers with volumes
	@docker-compose -f ${DOCKER_CONFIG} down -v

start: # start already created containers
	@docker-compose -f ${DOCKER_CONFIG} start

stop: # stop containers, but not destroy
	@docker-compose -f ${DOCKER_CONFIG} stop

ps: # show started containers and their status
	@docker-compose -f ${DOCKER_CONFIG} ps

build:# build all dockerfile, if not built yet
	@docker-compose -f ${DOCKER_CONFIG} build

memory:
	sudo sysctl -w vm.max_map_count=262144

connect_app: # php-fpm command line
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm sh

connect_nginx: # nginx command line
	@docker-compose -f ${DOCKER_CONFIG} exec -w /www nginx sh

connect_db: # database command line
	@docker-compose -f ${DOCKER_CONFIG} exec db bash

connect_test_db: # database command line
	@docker-compose -f ${DOCKER_CONFIG} exec test-db bash

init: # laravel install
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm composer create-project symfony/website-skeleton .

vendor: # composer install
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm composer install

add_controller:
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm bin/console make:controller

add_entity:
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm bin/console make:entity

add_crud:
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm bin/console make:crud $(name)

diff:
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm bin/console doctrine:migrations:diff

migrate:
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm bin/console doctrine:migrations:migrate

prev:
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm bin/console doctrine:migrations:migrate prev

cache_clear:
	@docker-compose -f ${DOCKER_CONFIG} exec -u www -w /www/app php-fpm bin/console cache:clear
