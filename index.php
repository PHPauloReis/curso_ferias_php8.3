<?php declare(strict_types=1);

require 'vendor/autoload.php';

use App\Controllers\ProductsController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new Router;

$router->map('GET', '/', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
});

$router->map('GET', '/produtos', [new ProductsController(), 'index']);

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

