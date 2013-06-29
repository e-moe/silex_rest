<?php
require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use controller\ApiController;
use controller\SiteController;

$app->mount('/', new SiteController());
$app->mount('/api', new ApiController());

return $app;