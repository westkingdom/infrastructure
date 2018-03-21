<?php

$aliases['live'] = array (
  'parent' => '@server.xalg',
  'root' => '/srv/www/live.westkingdom.org/drupal',
  'uri' => 'http://westkingdom.org',
  'path-aliases' => array(
    '%drush-script' => 'drush',
  ),
);

$aliases['stage'] = array (
  'parent' => '@server.xalg',
  'root' => '/srv/www/stage.westkingdom.org/drupal',
  'uri' => 'http://stage.westkingdom.org',
  'target-command-specific' => array(
    'sql-sync' => array(
      'no-cache' => TRUE,
      'enable' => array('devel', 'stage_file_proxy'),
      'disable' => array('passwordless'),
      'sanitize' => TRUE,
      'permission' => array(
        'authenticated user' => array(
          'add' => array('access devel information', 'access environment indicator'),
        ),
        'anonymous user' => array(
          'add' => 'access environment indicator',
        ),
      ),
    ),
  ),
);

$sanitizePasswordFile = __DIR__ . '/sanitize-password.txt';
if (file_exists($sanitizePasswordFile)) {
  $sanitizePassword = file_get_contents($sanitizePasswordFile);
  $aliases['stage']['target-command-specific']['sql-sync']['sanitize-password'] = trim($sanitizePassword);
}
