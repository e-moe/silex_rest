<?php
namespace controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

class SiteController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () use ($app) {
            $data = $app['DataProvider']->getAllAddresses();
            return $app->render(
                'index.twig',
                array(
                    'data' => $data,
                )
            );
        })->bind('index');

        $controllers->get('/help/', function () use ($app) {
            return $app->render('help.twig');
        })->bind('help');

        return $controllers;
    }
}
