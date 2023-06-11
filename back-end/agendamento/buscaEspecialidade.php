<?php
require "../includes/conexao.php";
$pdo = mysqlConnect();

try {
    $sql = <<<SQL
    SELECT especialidade
    FROM medico
    GROUP BY especialidade
SQL;

    $stmt = $pdo->query($sql);

} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}

while ($row = $stmt->fetch()) {
    $especialidades[] = htmlspecialchars($row['especialidade']);
}

header('Content-type: application/json');
echo json_encode($especialidades);

?>