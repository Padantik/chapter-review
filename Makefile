strip-db:
	bin/console doctrine:database:drop -f
	bin/console doctrine:database:drop -f --env=test

	bin/console doctrine:database:create
	bin/console doctrine:database:create --env=test

diff:
	bin/console doctrine:migrations:diff

mig:
	bin/console doctrine:migrations:migrate
	bin/console doctrine:migrations:migrate --env=test

test:
	php bin/phpunit