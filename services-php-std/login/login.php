<?php

use Google\Cloud\PubSub\PubSubClient;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Response;

function pubUserInTopic($projectId, $topicName, $message)
{
    $app = new Application();
    $app->register(new TwigServiceProvider());
    $app['twig.path'] = [ __DIR__ ];
    $app->get('/', function () use ($app) {
        return $app['twig']->render('pubsub.html.twig', [
            'project_id' => $app['upjv-ccm-etu-006'],
        ]);
    });


    $projectId = $app['upjv-ccm-etu-006'];
    $topicName = $app['UsersList'];
    $app['request']->set('message', 'test');
    # [START send]
    if ($message = $app['request']->get('message')) {
        // Publish the pubsub message to the topic
        $pubsub = new PubSubClient([
            'projectId' => $projectId,
        ]);
        $topic = $pubsub->topic($topicName);
        $topic->publish(['data' => $message]);
        return new Response('', 204);
    }
    # [END send]
    return new Response('', 400);
}
?>