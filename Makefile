# Functions

# make_version
# params : $(1) version
#
define make_version
	@semver inc $(1)
	@echo "New release: `semver tag`"
	@git add .semver
	@git commit -m "Releasing `semver tag`"
	@git tag -a `semver tag` -m "Releasing `semver tag`"
endef

.DEFAULT_GOAL := help

#
# Thanks to https://blog.theodo.fr/2018/05/why-you-need-a-makefile-on-your-project/
#

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'


## Installation
install: ## Installe les dépendances composer
	php composer.phar install

## Administration
major: ## Monte la version majeure du logiciel
	$(call make_version,major)

minor:  ## Monte la version mineure du logiciel
	$(call make_version,minor)

patch:  ## Monte la version patch du logiciel
	$(call make_version,patch)

## CI
test: test-unit test-functional ## Lance tous les tests applicatifs

test-unit: ## Lance les tests unitaires
	Vendor/Bin/atoum -ulr

test-functional: ## Lance les tests fonctionnels
	cp Tests/Functionals/_data/database.sqlite Tests/Functionals/_data/current.sqlite
	Vendor/Bin/codecept run api -f
