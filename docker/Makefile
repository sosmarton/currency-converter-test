.PHONY: install install-server install-docker

install-docker: 
	sudo apt-get update
	sudo apt-get install -y docker docker-compose
install: compose up

test:
	php artisan test
remove:
	sudo docker-compose down -v --rmi all --remove-orphans
clean-install: remove install
compose:
	sudo docker-compose build --no-cache
rebuild:
	sudo docker-compose up -d --no-deps --build $(img)
up:
	sudo docker-compose up -d
run:
	sudo docker-compose start
stop:
	sudo docker-compose stop
down:
	sudo docker-compose down
enter:
	sudo docker exec -i -t $(img) /bin/ash
show-imgs:
	sudo docker ps
