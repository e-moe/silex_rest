<?php
use Symfony\Component\HttpFoundation\Request;

$app->get('/api/', function() use ($app) {
    $data = $app['DataProvider']->getAllAddresses();
    return $app->json($data);
})->bind('api');

$app->get('/api/{id}', function($id) use ($app) {
    $data = $app['DataProvider']->getAddress($id);
    return $app->json($data, !is_null($data) ? 200 : 404);
})->assert('id', '\d+');

$app->post('/api/', function (Request $request) use ($app) {
    $insertId = $app['DataProvider']->addAddress($request->request->all());
    if (!is_null($insertId)) {
        $app->log(sprintf("Entity with id '%u' created.", $insertId));
    }
    return $app->json(
        array(
            'hasErrors' => !is_null($insertId),
            'errors' => !is_null($insertId) ? null : 'Item can\'t be created',
            'Id' => $insertId,
        ),
        !is_null($insertId) ? 201 : 400
    );
});

$app->put('/api/{id}', function(Request $request, $id) use ($app) {
    $updated = $app['DataProvider']->updateAddress($id, $request->request->all());
    if ($updated) {
        $app->log(sprintf("Entity with id '%u' updated.", $id));
    }
    return $app->json(
        array(
            'hasErrors' => !$updated,
            'errors' => $updated ? null : 'Item can\'t be updated',
            'Id' => $id,
        ),
        $updated ? 201 : 400
    );
})->assert('id', '\d+');

$app->delete('/api/{id}', function($id) use ($app) {
    $deleted = $app['DataProvider']->removeAddress($id);
    if ($deleted) {
        $app->log(sprintf("Entity with id '%u' deleted.", $id));
    }
    return $app->json(
        array(
            'hasErrors' => !$deleted,
            'errors' => $deleted ? null : 'Item can\'t be removed',
            'Id' => $id,
        ),
        $deleted ? 200 : 400
    );
})->assert('id', '\d+');