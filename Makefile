.PHONY: all

include .env

WORKSPACE:=$(shell pwd)/
UID:=$(shell id -u)

PROJECT_NAME=symfony
PROJECT_NETWORK=symfony
PROJECT_DB_NAME=symfony
CMD_DOCKER_COMPOSE=docker-compose

export UID
export WORKSPACE

prune:
	make down
	docker system prune -af
	sudo rm -rf tools/docker/postgresql/data/*
	sudo chmod 777 -Rf tools/docker/postgresql/data

install:
	make up
	# make symfony cmd='new blog --webapp'

reinstall:
	make prune
	make install

up:
	$(CMD_DOCKER_COMPOSE) up -d

build:
	$(CMD_DOCKER_COMPOSE) up -d --build

rebuild:
	make prune
	make build

down:
	$(CMD_DOCKER_COMPOSE) down

stop:
	$(CMD_DOCKER_COMPOSE) stop

ssh-nginx:
	$(CMD_DOCKER_COMPOSE) exec --user www-data $(PROJECT_NAME)_nginx /bin/bash

ssh-psql:
	$(CMD_DOCKER_COMPOSE) exec --user www-data $(PROJECT_NAME)_db psql -U postgresql $(PROJECT_DB_NAME)

ssh-php:
	$(CMD_DOCKER_COMPOSE) exec --user www-data $(PROJECT_NAME) /bin/bash

ssh-php-root:
	$(CMD_DOCKER_COMPOSE) exec --user root $(PROJECT_NAME) /bin/bash

symfony:
	$(CMD_DOCKER_COMPOSE) exec --user www-data $(PROJECT_NAME) symfony ${cmd}

console:
	$(CMD_DOCKER_COMPOSE) exec --user www-data $(PROJECT_NAME) bash -c 'cd ./moncv && symfony console ${cmd}'

composer:
	$(CMD_DOCKER_COMPOSE) exec --user www-data $(PROJECT_NAME) bash -c 'cd ./moncv && symfony composer ${cmd}'