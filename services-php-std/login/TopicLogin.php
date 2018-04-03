<?php
use Google\Cloud\PubSub\PubSubClient;

$app['pubsub.client'] = function ($app) {
    // create the pubsub client
    $projectId = $app['config']['google_project_id'];
    $pubsub = new PubSubClient([
        'projectId' => $projectId,
    ]);
    return $pubsub;
};