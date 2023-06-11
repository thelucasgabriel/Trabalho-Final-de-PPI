<?php

require "../includes/conexao.php";
$pdo = mysqlConnect();

//Resgata os dados do Paciente
$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["tel"] ?? "";

//Resgata os dados do Agendamento
$dhConsulta = $_POST["dhconsulta"] ?? "";
$codMedico = $_POST["medespec"] ?? "";

//Resgate de dados somente para validação (não serão inseridos)
$especialidade = $_POST["espec"] ?? "";
$medicoEspecialista = $_POST["medespec"] ?? "";

$errorMsg = []; // vetor para armazenar as mensagens de erro

// Validação dos campos
if (trim($especialidade) == "") {
    $errorMsg[] = "A especialidade é obrigatória.";
}
if (trim($medicoEspecialista) == "") {
    $errorMsg[] = "O médico especialista é obrigatório.";
}
if (trim($dhConsulta) == "") {
    $errorMsg[] = "A data é obrigatória.";
}
if (trim($nome) == "") {
    $errorMsg[] = "O nome é obrigatório.";
}
if (trim($sexo) == "") {
    $errorMsg[] = "O sexo é obrigatório.";
}
if (trim($email) == "") {
    $errorMsg[] = "O e-mail é obrigatório.";
}
if (trim($telefone) == "") {
    $errorMsg[] = "O telefone é obrigatório.";
}

if (count($errorMsg) > 0) {
    //exibe as mensagens de erro
    foreach ($errorMsg as $error) {
        echo $error . "<br>";
    }

    echo "Você será redirecionado(a) para a página de Agendamentos em 5s.";

    header("Refresh: 5; URL=../../front-end/area-publica/agendamento.html");
    exit();
} else {
    $sql1 = <<<SQL
    INSERT INTO paciente (nome, sexo, email, telefone)
    VALUES (?, ?, ?, ?)
SQL;

    $sql2 = <<<SQL
    INSERT INTO agendamento (datahora, codigo_medico, codigo_paciente)
    VALUES (?, ?, ?) 
SQL;

    try {
        $pdo->beginTransaction();
        $stmt1 = $pdo->prepare($sql1);
        if (!$stmt1->execute([$nome, $sexo, $email, $telefone])) {
            throw new Exception("Falha na primeira inserção");
        }

        $idPaciente = $pdo->lastInsertId();
        $stmt2 = $pdo->prepare($sql2);
        if (!$stmt2->execute([$dhConsulta, $codMedico, $idPaciente])) {
            throw new Exception("Falha na segunda inserção");
        }

        $pdo->commit();

        header(
            "Location: ../../front-end/area-publica/agendamento.html"
        );
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        if ($e->errorInfo[1] === 1062) {
            exit("Dados duplicados: " . $e->getMessage());
        } else {
            exit("Falha ao cadastrar os dados: " . $e->getMessage());
        }
    }
}
?>
