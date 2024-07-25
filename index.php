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
    
    $sql = '
        SELECT 
            `p`.`id`, `c`.`titulo` AS `categoria`, `p`.`nome`, 
            `p`.`descricao`, `p`.`preco`  from produtos AS `p` 
        INNER JOIN 
            categorias AS `c` ON `c`.`id` = `p`.`categoria_id`
    ';
    $statement = $pdo->query($sql);
    
    $produtos = $statement->fetchAll();

    foreach ($produtos as $produto) {
        echo "O produto {$produto['nome']}, da categoria {$produto['categoria']}, custa R$ " . number_format($produto['preco'], 2, ',', '.') . "<br>";
    }
} catch (PDOException $exception) {
    die("Não foi possível se conectar com o banco de dados. Motivo: {$exception->getMessage()}");
}
