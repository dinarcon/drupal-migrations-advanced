<?php

namespace Drupal\ud_book\EventSubscriber;

use Drupal\Core\Site\Settings;
use Drupal\migrate\Event\MigrateEvents;
use Drupal\migrate\Event\MigrateImportEvent;
use Drupal\migrate_plus\Event\MigrateEvents as MigratePlusEvents;
use Drupal\migrate_plus\Event\MigratePrepareRowEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscriber.
 */
class UdBookMigrateEventsSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = [];

    $events[MigratePlusEvents::PREPARE_ROW][] = ['onPrepareRow'];
    $events[MigrateEvents::PRE_IMPORT] = ['onPreImport'];

    return $events;
  }

  /**
   * Prepares row.
   */
  public function onPrepareRow(MigratePrepareRowEvent $event) {
    $migration = $event->getMigration();

    if ($migration->id() == 'ud_book_json_auth_node') {
      $row = $event->getRow();
      $year = (int) $row->getSourceProperty('src_year');
      if ($year % 2 === 0) {
        $row->setSourceProperty('src_custom', rand(1, 100));
      }
    }
  }

  /**
   * Adds OAuth2 authentication data.
   */
  public function onPreImport(MigrateImportEvent $event) {
    $migration = $event->getMigration();
    $tags = $migration->getMigrationTags();

    // Consider setting source configuration 'skip_count' to TRUE.
    if (in_array('UD Migrations OAuth2', $tags)) {
      $source_config = $migration->getSourceConfiguration();

      // The 'data_fetcher_plugin' must be set to 'http'.
      // $source_config['data_fetcher_plugin'] = 'http';

      // The authentication plugin must be set to 'oauth2'
      // $source_config['authentication']['plugin'] = 'oauth2';

      $source_config['authentication']['grant_type'] = 'client_credentials';
      $source_config['authentication']['base_uri'] = 'https://understanddrupal.com';
      $source_config['authentication']['client_id'] = '/oauth2/token';
      $source_config['authentication']['token_url'] = Settings::get('ud_book_client_id');
      $source_config['authentication']['client_secret'] = Settings::get('ud_book_client_secret');

      $migration->set('source', $source_config);
    }
  }

}
