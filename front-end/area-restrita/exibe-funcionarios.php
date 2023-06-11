<?php
require "../../back-end/includes/conexao.php";
$pdo = mysqlConnect();
try {
    $sql = <<<SQL
    SELECT nome, email, senha_hash, estado_civil, data_nascimento, funcao
    FROM funcionario
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
    <title>Listagem dos Funcionários</title>
</head>

<body>
    <div id="container">
        <table>
            <caption>Listagem dos Funcionários</caption>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Estado Civil</th>
                    <th>Data de Nascimento</th>
                    <th>Função</th>
                    <th>Hash da Senha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch()) {

                    //Tratamento dos dados inseridos pelo usuário
                    $nome = htmlspecialchars($row['nome']);
                    $email = htmlspecialchars($row['email']);
                    $estadoCivil = htmlspecialchars($row['estado_civil']);

                    $data = new DateTime($row['data_nascimento']);
                    $dataFormatoDiaMesAno = $data->format('d-m-Y');

                    $funcao = htmlspecialchars($row['funcao']);


                    echo <<<HTML
                <tr>
                    <td>$nome</td>
                    <td>$email</td>
                    <td>$estadoCivil</td>
                    <td>$dataFormatoDiaMesAno</td>
                    <td>$funcao</td>
                    <td>{$row['senha_hash']}</td>
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