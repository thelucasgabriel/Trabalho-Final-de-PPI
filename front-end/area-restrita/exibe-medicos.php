<?php
require "../../back-end/includes/conexao.php";
$pdo = mysqlConnect();
try {
    $sql = <<<SQL
    SELECT nome, especialidade, crm
    FROM medico
    SQL;

    $stmt = $pdo->query($sql);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/table.css">
    <title>Listagem dos Médicos</title>
</head>

<body>
    <div id="container">
        <table>
            <caption>Listagem de Funcionários</caption>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>CRM</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch()) {

                    //Tratamento dos dados inseridos pelo usuário
                    $nome = htmlspecialchars($row['nome']);
                    $espec = htmlspecialchars($row['especialidade']);
                    $crm = htmlspecialchars($row['crm']);


                    echo <<<HTML
                <tr>
                    <td>$nome</td>
                    <td>$espec</td>
                    <td>$crm</td>
                </tr>
            HTML;
                }
                ?>
            </tbody>
        </table>
    </div>
    <a href="index.html">Home</a>
</body>

</html>