<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card mt-5">
                    <div class="card-header">
                        <h5>Listagem de Produtos</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                            </tr>
                            <?php foreach($products as $product): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo $product['nome']; ?></td>
                                <td><?php echo $product['descricao']; ?></td>
                                <td><?php echo $product['preco']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
    
</body>
</html>