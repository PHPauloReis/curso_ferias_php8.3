<?php

$host = 'localhost';
$db = 'curso_ferias';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";

$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    $id = $_GET['id'] ?? '';
    
    $sql = '
        SELECT 
            `p`.`id`, `c`.`titulo` AS `categoria`, `p`.`nome`, 
            `p`.`descricao`, `p`.`preco`  from produtos AS `p` 
        INNER JOIN 
            categorias AS `c` ON `c`.`id` = `p`.`categoria_id`
    ';
    $statement = $pdo->query($sql);
    
    $produtos = $statement->fetchAll();

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
                    </tr>

                    <?php foreach($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['categoria']; ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>

                </table>

            </div>
        </div>
    </div>
    
</body>
</html>
