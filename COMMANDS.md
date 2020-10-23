# Commands

This is a list of some commands used throughout the course.

```
COMPOSER_MEMORY_LIMIT=-1 composer create-project drupal/recommended-project:^9.0.0 migrations-advanced

cd migrations-advanced

COMPOSER_MEMORY_LIMIT=-1 composer require 'drupal/olivero:^1.0' 'drush/drush' 'drupal/migrate_plus:^5.1' 'drupal/migrate_tools:^5.0' 'drupal/migrate_source_html:^1.0' 'drupal/devel:^4.0' 'drupal/migrate_devel:^2.0@alpha' 'cweagans/composer-patches'

vim composer.json

composer validate

composer install

composer remove drupal/core-project-message

mkdir -p web/modules/custom

cd web/modules/custom && git clone https://github.com/dinarcon/drupal-migrations-advanced.git && mv drupal-migrations-advanced ud_book && rm -rf ud_book/.git && cd ../../..

php web/core/scripts/drupal quick-start standard --site-name "UnderstandDrupal.com/migrations" --suppress-login

./vendor/bin/drush theme:enable olivero && ./vendor/bin/drush --yes config:set olivero.settings debug 0 && ./vendor/bin/drush --yes config:set system.theme default olivero

./vendor/bin/drush theme:enable claro && ./vendor/bin/drush --yes config:set system.theme admin claro

./vendor/bin/drush pm:enable --yes ud_book migrate_devel

# Import all migrations.
./vendor/bin/drush migrate:import --tag='UD Migrations Advanced Example'

# Roll back all migrations.
./vendor/bin/drush migrate:rollback --tag='UD Migrations Advanced Example'

# Uninstall example module. This removes the included configuration: content type, fields, taxonomy vocabulary, view, etc.
./vendor/bin/drush pm:uninstall --yes ud_book ud_book_setup
```

```
./vendor/bin/drush list --filter=migrate
./vendor/bin/drush migrate:import ud_book_json_node_init
./vendor/bin/drush migrate:status --fields=id,status,total,imported,unprocessed,last_imported
./vendor/bin/drush migrate:stop ud_book_json_node_init
./vendor/bin/drush migrate:reset-status ud_book_json_node_init
./vendor/bin/drush migrate:rollback ud_book_json_node_init
./vendor/bin/drush cache:rebuild
./vendor/bin/drush migrate:import ud_book_json_node_init
./vendor/bin/drush migrate:messages ud_book_json_node_init
```

```
./vendor/bin/drush migrate:import ud_book_json_node_init --execute-dependencies
./vendor/bin/drush migrate:import --tag='UD Migrations Advanced Example'
./vendor/bin/drush migrate:import --all

./vendor/bin/drush migrate:rollback --tag='UD Migrations Advanced Example'
./vendor/bin/drush migrate:rollback --all
```

```
# DDEV setup.
ddev config
ddev start
ddev ssh

cd ..
./vendor/bin/drush site:install standard --site-name "UnderstandDrupal.com/migrations" --account-name=admin --account-pass=admin

enable_xdebug
./vendor/bin/drush migrate:import ud_book_json_node_init
disable_xdebug

exit
ddev stop
```
