<?php

$aliases['stage'] = array (
  'parent' => '@server.site5-uvps1-dev',
  'root' => '/srv/www/stage.westkingdom.org/drupal',
  'uri' => 'http://stage.westkingdom.org',
  'target-command-specific' => array(
    'sql-sync' => array(
      'no-cache' => TRUE,
      'enable' => array('devel', 'stage_file_proxy'),
      'disable' => array('passwordless'),
      'sanitize' => TRUE,
      'sanitize-password' => '1066',
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

$aliases['live'] = array (
  'parent' => '@server.site5-uvps1',
  'root' => '/srv/www/live.westkingdom.org/drupal',
  'uri' => 'http://westkingdom.org',
  'path-aliases' => array(
    '%drush-script' => 'drush',
  ),
);
