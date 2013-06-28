<?php
use Symfony\Component\HttpFoundation\Request;

$app->get('/api/', function() use ($app) {
    $sql = 'SELECT * FROM `address`';
    $data = $app['db']->fetchAll($sql);
    return $app->json($data);
})->bind('api');

$app->get('/api/{id}', function($id) use ($app) {
    $sql = 'SELECT * FROM `address` WHERE `id` = ?';
    $data = $app['db']->fetchAssoc($sql, array(intval($id)));
    return $app->json($data, $data ? 200 : 404);
})->assert('id', '\d+');

$app->post('/api/', function (Request $request) use ($app) {
    $post = array(
        'label' => $request->request->get('label', ''),
        'street'  => $request->request->get('street', ''),
        'housenumber'  => $request->request->get('housenumber', ''),
        'postalcode'  => $request->request->get('postalcode', ''),
        'city'  => $request->request->get('city', ''),
        'country'  => $request->request->get('country', ''),
    );

    $inserted = $app['db']->insert('address', $post);
    $response = array(
        'hasErrors' => !$inserted,
        'errors' => $inserted ? null : 'Item can\'t be created',
    );
    if ($inserted) {
        $post['id'] = $app['db']->lastInsertId();
        $response['Id'] = $post['id'];
        $app->log(sprintf("Entity with id '%u' created.", $post['id']));
    }

    return $app->json(
        $response,
        $inserted ? 201 : 400
    );
});

$app->put('/api/{id}', function(Request $request, $id) use ($app) {
    $put = array(
        'label' => $request->request->get('label', ''),
        'street'  => $request->request->get('street', ''),
        'housenumber'  => $request->request->get('housenumber', ''),
        'postalcode'  => $request->request->get('postalcode', ''),
        'city'  => $request->request->get('city', ''),
        'country'  => $request->request->get('country', ''),
    );

    $updated = (bool)$app['db']->update('address', $put, array('id' => $id));
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
    $deleted = (bool)$app['db']->delete('address', array('id' => $id));
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