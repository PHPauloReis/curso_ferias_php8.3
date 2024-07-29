<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductsController
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response();
        $productModel = new ProductModel;

        $products = $productModel->getAll();

        ob_start();
        include __DIR__ . '/../Views/products.php';
        $htmlContent = ob_get_clean();

        $response->getBody()->write($htmlContent);

        return $response;
    }
}