# Understand Drupal Migrations Course - Advanced package

A demo module created by [Mauricio Dinarte](https://www.drupal.org/u/dinarcon) ([@dinarcon](https://twitter.com/dinarcon)) to explain migrations concepts in Drupal.

This module is part of the [Understand Drupal Migrations Course](https://understanddrupal.com/migrations) which can be purchased at https://udrupal.com/get-migrations-course

## Dependencies

The following projects are required to run this demo. The numbers indicate which version of the project was last used for testing.

* [Drupal](https://www.drupal.org/project/drupal) 9.1.5
* [Migrate plus](https://www.drupal.org/project/migrate_plus) 8.x-5.1
* [Migrate source HTML](https://www.drupal.org/project/migrate_source_html) 1.0.0
* [Migrate tools](https://www.drupal.org/project/migrate_tools) 8.x-5.0
* [Drush](https://github.com/drush-ops/drush) 10.3.6

Although not required to run the example migrations, the following module is used in the debugging lessons:

* [Migrate devel](https://www.drupal.org/project/migrate_devel) 8.x-2.0-alpha2

### Specific Drush version required

Drush `10.4` and later is not compatible with `migrate_tools <= 5`. Until a `6.x` branch is released for `migrate_tools`, Drush needs to be pinned to `^10.3.0` via Composer.

## Examples

This demo includes eight migrations. All of them use a JSON file as the source.

* `ud_book_html_file` for importing images from HTML files. There are no dependencies on other migrations.
* `ud_book_json_file` for importing images from HTML content embedded in a local JSON file. This migration is **not** detected out of the box because the file extension is `.txt` instead of `.yml`. The images are actually imported in the `ud_book_json_node` migration. This migration was added for reference only.
* `ud_book_json_node` for importing nodes from HTML content embedded in a local JSON file. Depends on `ud_book_html_file`.
* `ud_book_json_auth_node` for importing nodes from remote JSON file. There are no dependencies on other migrations.

## Instructions

* Install module dependencies via Composer: `composer require 'drupal/migrate_devel:^2.0@alpha' 'drupal/migrate_plus:^5.1' 'drupal/migrate_source_html:^1.0' 'drupal/migrate_tools:^5.0'`
* Install the **Drush 10.3.x** via Composer: `composer require 'drush/drush:^10.3.0'`. After this step, you may call it via `./vendor/bin/drush`.
* Make sure your Drupal installation has a `/modules/custom` folder. The `modules` folder should exist, but the `custom` sub-folder might not. Create it if needed.
* Download the demo module contained in this repository into the `/modules/custom` folder. You can do this by cloning this repository or [downloading a ZIP file](https://github.com/dinarcon/drupal-migrations-advanced/archive/main.zip). **Important:** In either case, you need to rename the folder to `ud_book`. Otherwise, the migrations will not find the JSON file used as source data.
* Enable the *UD Book Example Migration* (`ud_book`) module.
* Run the migrations using Drush. See instructions below.
* Check out the [DEVELOPMENT.md](DEVELOPMENT.md) file for instructions on configuring a local development environment.
* Check out the [TROUBLESHOOTING.md](TROUBLESHOOTING.md) file for solutions to common problems.

### Importing the migrations

Import all migrations using the following Drush command:

`./vendor/bin/drush migrate:import --tag='UD Migrations Advanced Example'`

### Rolling back the migrations

Rollback all migrations using the following Drush command:

`./vendor/bin/drush migrate:rollback --tag='UD Migrations Advanced Example'`
