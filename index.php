<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/funcoes/gerenciamento_produto.php';

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    $id = $_GET['id'] ?? '';

    $idProdutoDeletar = $_GET['deletar'] ?? '';

    if (!empty($idProdutoDeletar)) {
        deletarProduto($pdo, $idProdutoDeletar);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomeDoProduto = $_POST['nome'];
        $descricaoDoProduto = $_POST['descricao'];
        $precoDoProduto = $_POST['preco'];

        cadastrarProduto($pdo, $nomeDoProduto, $descricaoDoProduto, $precoDoProduto);
    }

    $produtos = obterTodosOsProdutos($pdo);

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

                <h1 class="mt-5 mb-4">Meus produtos</h1>

                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Nome do produto</th>
                        <th>Categoria do produto</th>
                        <th>Preço do produto</th>
                        <th>Ação</th>
                    </tr>

                    <?php foreach($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['categoria']; ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href='atualizar.php?id=<?php echo $produto['id']; ?>'>Editar</a>
                            <a onclick="confirmarDelecao('<?php echo $produto['id']; ?>')" class="btn btn-danger btn-sm" href='#'>Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <h2 class="mt-5 mb-4">Cadastro de produto</h2>

                <form action="" method="post">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Produto</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao">
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="preco" name="preco">
                    </div>

                    <button class="btn btn-success">Cadastrar</button>

                </form>

            </div>
        </div>

    </div>

    <script>
        
    function confirmarDelecao(idProduto) {
        if (confirm('Você tem certeza que deseja excluir este produto?')) {
            window.location = `index.php?deletar=${idProduto}`;
        }
    }

    </script>
    
</body>
</html>
