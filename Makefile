.PHONY: install install-server install-docker

test:
	php artisan test
install-dependencies:
	composer update
generate-src:
	rsync -avr --exclude='docker/' --exclude='.editorconfig' --exclude='.env.example' --exclude=".env.testing" --exclude=".gitattributes" --exclude=".gitignore" --exclude=".git" . src/
