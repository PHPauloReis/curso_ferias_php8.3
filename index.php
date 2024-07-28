<?php

require 'vendor/autoload.php';

use App\Models\CategoryModel;
use App\Models\ProductModel;

$productModel = new ProductModel;

$novoProduto = [
    'nome' => 'Celular S24+',
    'descricao' => 'Smartphone com 512GB',
    'preco' => 7999
];

$productModel->insert($novoProduto);

var_dump($productModel->getAll());
// var_dump($productModel->getById(3));

// $categoryModel = new CategoryModel;
// var_dump($categoryModel->getAll());

// var_dump($categoryModel->getById(2));