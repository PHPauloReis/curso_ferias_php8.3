<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/funcoes/gerenciamento_produto.php';

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    $id = $_GET['id'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nomeDoProduto = $_POST['nome'];
        $descricaoDoProduto = $_POST['descricao'];
        $precoDoProduto = $_POST['preco'];

        atualizarProduto($pdo, $id, $nomeDoProduto, $descricaoDoProduto, $precoDoProduto);

        header('location: index.php');
    }

    $produto = obterProdutoPeloId($pdo, $id);

} catch (PDOException $exception) {
    die("Não foi possível se conectar com o banco de dados. Motivo: {$exception->getMessage()}");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha primeira aplicação com PHP + PDO + MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <h2 class="mt-5 mb-4">Atualização de produto</h2>

                <a class="btn btn-primary btn-sm" href="index.php">Voltar para os produtos</a>
                <hr>

                <form action="" method="post">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Produto</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produto['nome']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo $produto['descricao']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="preco" name="preco" value="<?php echo $produto['preco']; ?>">
                    </div>

                    <button class="btn btn-success">Atualizar</button>

                </form>

            </div>
        </div>

    </div>
    
</body>
</html>
