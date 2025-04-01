.PHONY: help cs-check cs-fix-real db-create migrate fixtures deploy tests cc

help:
	@echo ""
	@echo "Commandes disponibles :"
	@echo "  make cs-check        -> Vérifie le code avec PHP-CS-Fixer (dry-run)"
	@echo "  make cs-fix-real     -> Corrige le code avec PHP-CS-Fixer"
	@echo "  make db-create		  -> Créer si pas déjà fait la bdd sur l'hôte distant"
	@echo "  make migrate         -> Exécute les migrations sur l'hôte distant"
	@echo "  make fixtures        -> Charge les data fixtures sur l'hôte distant"
	@echo "  make deploy          -> Migration + fixtures (déploiement complet)"
	@echo "  make tests           -> Lance les tests PHPUnit"
	@echo "  make cc              -> Vide le cache Symfony"

# Vérification de code
cs-check:
	vendor/bin/php-cs-fixer fix --dry-run --diff

# Correction automatique
cs-fix-real:
	vendor/bin/php-cs-fixer fix

# Création de la base de données (nom dans env)
db-create:
	php bin/console doctrine:database:create --if-not-exists

# Migration des tables de la base de données
migrate:
	php bin/console doctrine:migrations:migrate --no-interaction

# Chargement des données
fixtures:
	php bin/console doctrine:fixtures:load --no-interaction

# Déploiement complet : migration + fixtures
deploy: migrate fixtures

# Lance les tests unitaires
tests:
	APP_ENV=test php bin/phpunit --testdox

# Pour vider le cache
cc:
	php bin/console cache:clear