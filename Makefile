start: build
	docker compose up -d

build:
	docker compose build

install:
	docker compose exec php composer install

test:
	docker compose exec php vendor/bin/phpunit --testdox src 

classnames.test:
	docker compose exec php vendor/bin/phpunit --testsuite classnames

unit.test:
	docker compose exec php vendor/bin/phpunit --testsuite unit --coverage-php reports/unit.php

integration.test:
	docker compose exec php vendor/bin/phpunit --testsuite integration --coverage-php reports/integration.php

merge-coverage:
	docker compose exec php bin/merge-coverage.php