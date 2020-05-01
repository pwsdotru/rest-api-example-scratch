.PHONY: build coverage sniff test 

build: sniff test ## Runs codestyle check and test targets 

coverage: vendor/autoload.php ## Collects coverage with phpunit 
	vendor/bin/phpunit --coverage-text --coverage-clover=.build/logs/clover.xml 

sniff: vendor/autoload.php ## Detects code style issues with phpcs 
	vendor/bin/phpcs --standard=PSR2 app -n 

test: vendor/autoload.php ## Runs tests with phpunit 
	vendor/bin/phpunit -d memory_limit=-1 

vendor/autoload.php: 
	composer install --no-interaction --prefer-dist 

