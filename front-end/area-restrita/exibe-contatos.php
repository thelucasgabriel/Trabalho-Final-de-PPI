<?php
require "../../back-end/includes/conexao.php";
$pdo = mysqlConnect();
try {
    $sql = <<<SQL
    SELECT nome, email, telefone, mensagem, datahora
    FROM contato
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
    <title>Listagem de Contatos</title>
</head>

<body>
    <div id="container">
        <table>
            <caption>Listagem dos Contatos</caption>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Mensagem</th>
                    <th>Data e Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch()) {

                    //Tratamento dos dados inseridos pelo usuário
                    $nome = htmlspecialchars($row['nome']);
                    $email = htmlspecialchars($row['email']);
                    $telefone = htmlspecialchars($row['telefone']);
                    $mensagem = htmlspecialchars($row['mensagem']);


                    $dataHora = new DateTime($row['datahora']);
                    $data = $dataHora->format('d-m-Y H:i:s');



                    echo <<<HTML
                <tr>
                    <td>$nome</td>
                    <td>$email</td>
                    <td>$telefone</td>
                    <td>$mensagem</td>
                    <td>$data</td>
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