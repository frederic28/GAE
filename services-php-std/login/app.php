<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Google\Cloud\Samples\PubSub;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Google\Cloud\PubSub\PubSubClient;
use Google\Cloud\Datastore\DatastoreClient;
$app = new Application();
$app->register(new TwigServiceProvider());
$app['twig.path'] = [ __DIR__ ];
$app->get('/', function () use ($app) {
    return $app['twig']->render('pubsub.html.twig', [
        'project_id' => $app['project_id'],
    ]);
});
$app->get('/fetch_messages', function () use ($app) {
    // get PUSH pubsub messages
    $projectId = $app['project_id'];
    $subscriptionName = $app['subscription'];
    $datastore = $app['datastore'];
    $query = $datastore->query()->kind('PubSubPushMessage');
    $messages = [];
    $pushKeys = [];
    foreach ($datastore->runQuery($query) as $pushMessage) {
        $pushKeys[] = $pushMessage->key();
        $messages[] = $pushMessage['message'];
    }
    // delete PUSH messages
    if ($pushKeys) {
        $datastore->deleteBatch($pushKeys);
    }
    # [START pull]
    // get PULL pubsub messages
    $pubsub = new PubSubClient([
        'projectId' => $projectId,
    ]);
    $subscription = $pubsub->subscription($subscriptionName);
    $pullMessages = [];
    foreach ($subscription->pull(['returnImmediately' => true]) as $pullMessage) {
        $pullMessages[] = $pullMessage;
        $messages[] = $pullMessage->data();
    }
    // acknowledge PULL messages
    if ($pullMessages) {
        $subscription->acknowledgeBatch($pullMessages);
    }
    # [END pull]
    return new JsonResponse($messages);
});
$app->post('/receive_message', function () use ($app) {
    # [START receive]
    // pull the message from the post body
    $json = $app['request']->getContent();
    $request = json_decode($json, true);
    if (
        !isset($request['message']['data'])
        || !$message = base64_decode($request['message']['data'])
    ) {
        return new Response('', 400);
    }
    # [END receive]
    // store the push message in datastore
    $datastore = $app['datastore'];
    $message = $datastore->entity('PubSubPushMessage', [
        'message' => $message
    ]);
    $datastore->insert($message);
    return new Response();
});
$app->post('/send_message', function () use ($app) {
    $projectId = $app['project_id'];
    $topicName = $app['topic'];
    $app['request']->set('message', 'test');
    # [START send]
    if ($message = $app['request']->get('message')) {
        // Publish the pubsub message to the topic
        $pubsub = new PubSubClient([
            'projectId' => $projectId,
        ]);
        $topic = $pubsub->topic($topicName);
        $response = $topic->publish(['data' => $message]);
        return new Response('', 204);
    }
    # [END send]
    return new Response('', 400);
});
$app['datastore'] = function () use ($app) {
    return new DatastoreClient([
        'projectId' => $app['project_id'],
    ]);
};
return $app;