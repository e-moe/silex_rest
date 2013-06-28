<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/api.php';

use Symfony\Component\HttpFoundation\Request;

$app->get('/', function(Request $request) use ($app) {
    $sql = 'SELECT * FROM `address`';
    $data = $app['db']->fetchAll($sql);
    return $app->render(
        'index.twig',
        array(
            'title' => 'Hello world! - Address book',
            'data' => $data,
        )
    );
})
->bind('index');

$app->get('/help/', function() use ($app) {
    return $app->render(
        'help.twig',
        array(
            'title' => 'Hello world! - Help',
        )
    );
})
->bind('help');

return $app;