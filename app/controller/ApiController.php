<?php
namespace controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function() use ($app) {
            $data = $app['DataProvider']->getAllAddresses();
            return $app->json($data);
        })->bind('api');

        $controllers->get('/{id}', function($id) use ($app) {
            $data = $app['DataProvider']->getAddress($id);
            return $app->json($data, !is_null($data) ? 200 : 404);
        })->assert('id', '\d+');

        $controllers->post('/', function (Request $request) use ($app) {
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

        $controllers->put('/{id}', function(Request $request, $id) use ($app) {
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

        $controllers->delete('/{id}', function($id) use ($app) {
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

        return $controllers;
    }
}