<?php
require "../../back-end/includes/conexao.php";
$pdo = mysqlConnect();

try {
    $sql = <<<SQL
    SELECT p.nome AS nome_paciente, m.nome AS nome_medico, m.especialidade AS especialidade, p.sexo AS sexo, p.email AS email, p.telefone AS telefone, a.datahora AS datahora, a.codigo AS codigo_agendamento
    FROM paciente p, agendamento a, medico m
    WHERE a.codigo_paciente = p.codigo
    AND m.codigo = a.codigo_medico;
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
    <title>Listagem de Agendamentos</title>
</head>

<body>
    <div id="container">
        <table>
            <caption>Listagem de Agendamentos de Pacientes</caption>
            <thead>
                <th>Nome</th>
                <th>Sexo</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Médico</th>
                <th>Especialidade</th>
                <th>Data e Hora</th>
                <th>Excluir</th>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch()) {

                    //Tratamento dos dados inseridos pelo usuário
                    $nomePaciente = htmlspecialchars($row['nome_paciente']);
                    $sexo = htmlspecialchars($row['sexo']);
                    $email = htmlspecialchars($row['email']);
                    $telefone = htmlspecialchars($row['telefone']);
                    $nomeMedico = htmlspecialchars($row['nome_medico']);
                    $especialidade = htmlspecialchars($row['especialidade']);

                    $dataHora = new DateTime($row['datahora']);
                    $data = $dataHora->format('d-m-Y H:i:s');


                    $codigoAgendamento = $row['codigo_agendamento'];

                    echo <<<HTML
        <tr>
            <td>$nomePaciente</td>
            <td>$sexo</td>
            <td>$email</td>
            <td>$telefone</td>
            <td>$nomeMedico</td>
            <td>$especialidade</td>
            <td>$data</td>
            <td>
              <a href="../../back-end/agendamento/exclui-agendamentos.php?codigo=$codigoAgendamento">
                Sim
              </a>
            </td>
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