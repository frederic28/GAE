<?php

// composer autoloading
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/app.php';
$app['project_id'] = getenv('GOOGLE_PROJECT_ID') ?: getenv('GCLOUD_PROJECT');
# [START pubsub_variables]
$app['topic'] = 'UsersList';
$app['subscription'] = 'test';
# [END pubsub_variables]
$app['debug'] = true;
$app->run();
