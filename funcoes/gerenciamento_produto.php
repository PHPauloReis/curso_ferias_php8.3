<?php

function cadastrarProduto($pdo, $nomeDoProduto, $descricaoDoProduto, $precoDoProduto)
{
    $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':nome', $nomeDoProduto);
    $statement->bindParam(':descricao', $descricaoDoProduto);
    $statement->bindParam(':preco', $precoDoProduto);
    $statement->execute();
}

function deletarProduto($pdo, $idProdutoDeletar)
{
    $sql = "DELETE FROM produtos WHERE id = :id";

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id', $idProdutoDeletar);
    $statement->execute();
}

function obterTodosOsProdutos($pdo)
{
    $sql = '
        SELECT 
            `p`.`id`, `c`.`titulo` AS `categoria`, `p`.`nome`, 
            `p`.`descricao`, `p`.`preco`  from produtos AS `p` 
        LEFT JOIN 
            categorias AS `c` ON `c`.`id` = `p`.`categoria_id`
    ';
    $statement = $pdo->query($sql);
    
    return $statement->fetchAll();
}

function obterProdutoPeloId($pdo, $id)
{
    $sql = 'SELECT * FROM produtos WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    
    return $statement->fetch();
}

function atualizarProduto($pdo, $id, $nomeDoProduto, $descricaoDoProduto, $precoDoProduto)
{
    $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':nome', $nomeDoProduto);
    $statement->bindParam(':descricao', $descricaoDoProduto);
    $statement->bindParam(':preco', $precoDoProduto);
    $statement->bindParam(':id', $id);
    $statement->execute();
}
