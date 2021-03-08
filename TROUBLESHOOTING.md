# Troubleshooting

## Drush command not defined or inability to install migrate_tools

This module works with Drupal 8 and 9. All the examples in this demo module assume Drush **10.3.x** is used. If you are using another version, the commands and their aliases might be different. Execute `./vendor/bin/drush list --filter=migrate` to verify the available commands for your version of Drush.

**Important:** Drush 10.4+ is not compatible with `migrate_tools` <= 5. Until a 6.x branch is release for `migrate_plus`, Drush needs to be pinned to `^10.3.0` via Composer.

If you are using Drush 10, make sure the [Migrate tools](https://www.drupal.org/project/migrate_tools) is **enabled** on the site. This module provides the commands for executing migrations from the command line.

## Memory limit errors when running Composer commands

Read more about this at the [Composer documentation](https://getcomposer.org/doc/articles/troubleshooting.md#memory-limit-errors). One of the proposed solution is prepending the command with `COMPOSER_MEMORY_LIMIT=-1`. For example:

`COMPOSER_MEMORY_LIMIT=-1 composer create-project drupal/recommended-project:^9.1 migrations-advanced`

## Fetching example data from a local JSON file

The `urls` configuration for the URL source plugin can be configured to read from a local file. In those cases it accepts either an absolute path or relative path from the Drupal's root folder. When using a relative path it is assumed that:

1. You have placed this demo module under the `modules/custom` folder.
1. The module's folder itself is renamed to `ud_book`.

Therefore, the JSON file should be located at `modules/custom/ud_book/sources/`. **Whether you clone this repository or download a ZIP file with its content, you need to rename the folder appropriately.** Otherwise, you will get an error similar to:

```
[error]  Could not retrieve source count from ud_book_json_node: file parser plugin: could not retrieve data from modules/custom/ud_book/sources/ud_migrations_advanced_data.json
```


