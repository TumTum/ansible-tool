all:
	@echo "Only build-phar target is currently supported."
	@echo "- build-phar"
	@echo "- install"

build-phar:
	@echo "--> Checking for composer command line tool"
	command -v composer >/dev/null && continue || { echo "composer command not found."; exit 1; }
	@echo "--> Cleaning vendor directory"
	rm -Rfv vendor
	@echo "--> Installing dependencies without dev"
	composer install --no-dev
	@echo "--> Building Phar"
	mkdir builds
	box build
	@echo "--> Success"

install:
	mv builds/ansible-tool.phar /usr/local/bin/ansible-tool

clean:
	rm -Rf builds

uninstall:
	rm -f /usr/local/bin/ansible-tool
