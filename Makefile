.PHONY: phpstan lint tests

phpstan:
	composer analyse

lint:
	composer lint:test

tests:
	composer test
